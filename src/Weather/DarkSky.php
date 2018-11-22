<?php
namespace Oliver\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Oliver\Weather\WeatherServiceInterface;
use Oliver\Weather\Exception\InvalidCoordinatesException;
use Oliver\Weather\Exception\NotFloatException;


/**
 *
 */
class DarkSky implements ContainerInjectableInterface, WeatherServiceInterface
{
    use ContainerInjectableTrait;

    private $baseUrl;
    private $apiKey;
    private $lat;
    private $long;

    public function configure(array $config)
    {
        $this->baseUrl = $config["baseUrl"];
        $this->apiKey = $config["apiKey"];
    }

    public function setLocation($lat, $long)
    {
        if (!floatval($lat)) {
            throw new NotFloatException("Latitud hade inte rätt format");
        }
        if (!floatval($long)) {
            throw new NotFloatException("Longitud hade inte rätt format");
        }
        $this->lat = $lat;
        $this->long = $long;
    }

    public function fetchWeather() : array
    {


        // $ch = curl_multi_init();
        // curl_multi_setopt($ch, CURLOPT_URL, "$this->baseUrl/$this->apiKey/$this->lat,$this->long?units=si&lang=sv");
        // curl_multi_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $res = curl_multi_exec($ch);
        // curl_multi_close($ch);
        // $json = json_decode($res, true);
        //
        // if (array_key_exists("error", $json)) {
        //     throw new InvalidCoordinatesException("Platsen hittades inte.<br>Latitude: $this->lat<br>Longitude: $this->long");
        // }
        //
        // return $json;




        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$this->baseUrl/$this->apiKey/$this->lat,$this->long?units=si&lang=sv");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($res, true);

        if (array_key_exists("error", $json)) {
            throw new InvalidCoordinatesException("Platsen hittades inte.<br>Latitude: $this->lat<br>Longitude: $this->long");
        }

        return $json;
    }


}
