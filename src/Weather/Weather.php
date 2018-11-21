<?php
namespace Oliver\Weather;

// use Anax\Commons\ContainerInjectableInterface;
// use Anax\Commons\ContainerInjectableTrait;
//
use Oliver\Weather\Exception\InvalidCoordinatesException;
use Oliver\Weather\Exception\NotFloatException;

/**
 *
 */
class Weather
{
    private $service;

    private $latitude;
    private $longitude;
    private $position;
    private $city;
    private $temperature;

    function __construct($service, $latitude, $longitude)
    {
        $this->service = $service;
        $this->fetchWeather($latitude, $longitude);
    }

    public function fetchWeather(string $latitude, string $longitude)
    {
        try {
            $this->service->setLocation($latitude, $longitude);
            $weatherJSON = $this->service->fetchWeather();
            $this->latitude = $weatherJSON["latitude"];
            $this->longitude = $weatherJSON["longitude"];



            // echo "<pre>";
            // var_dump($weatherJSON);
        } catch (\NotFloatException $e) {
            throw new \NotFloatException($e->getMessage());
        } catch (\InvalidCoordinatesException $e) {
            throw new \InvalidCoordinatesException($e->getMessage());
        }
    }

    public function getWeather() : object
    {
        return (object)[
            "latitude" => strval($this->latitude),
            "longitude" => strval($this->longitude),
        ];
    }


}
