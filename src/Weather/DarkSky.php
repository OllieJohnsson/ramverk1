<?php
namespace Oliver\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Oliver\Weather\WeatherServiceInterface;
use Oliver\Weather\Exception\InvalidLocationException;


/**
 *
 */
class DarkSky implements ContainerInjectableInterface, WeatherServiceInterface
{
    use ContainerInjectableTrait;

    private $baseUrl;
    private $apiKey;


    public function configure(array $config)
    {
        $this->baseUrl = $config["baseUrl"];
        $this->apiKey = $config["apiKey"];
    }


    public function fetchWeather($coordinates) : array
    {
        $ch = [];
        $mh = curl_multi_init();
        for ($i = 0; $i < count($coordinates); $i++) {
            $lat = $coordinates[$i]["lat"];
            $long = $coordinates[$i]["long"];

            $url = "$this->baseUrl/$this->apiKey/$lat,$long?units=si&lang=sv";

            $ch[$i] = curl_init($url);
            curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($mh, $ch[$i]);
        }

        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        $results = [];
        for ($i=0; $i < count($ch); $i++) {
            $results[] = (json_decode(curl_multi_getcontent($ch[$i]), true));

            if (array_key_exists("error", $results[$i])) {
                $lat = $coordinates[$i]["lat"];
                $long = $coordinates[$i]["long"];
                throw new InvalidLocationException("Platsen hittades inte.<br>Latitud: <b>$lat</b><br>Longitud: <b>$long</b>");
            }
        }
        return $results;
    }
}
