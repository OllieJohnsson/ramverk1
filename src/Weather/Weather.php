<?php
namespace Oliver\Weather;

// use Anax\Commons\ContainerInjectableInterface;
// use Anax\Commons\ContainerInjectableTrait;
//
// use Oliver\Weather\Exception\InvalidCoordinatesException;
// use Oliver\Weather\Exception\NotFloatException;


/**
 *
 */
class Weather
{
    private $service;

    private $latitude;
    private $longitude;
    private $currently;
    private $daily;

    private $icons = [
        "clear-day" => "☀️",
        "clear-night" => "🌝",
        "rain" => "🌧",
        "snow" => "❄️",
        "sleet" => "🌨",
        "wind" => "💨",
        "fog" => "🌫",
        "cloudy" => "☁️",
        "partly-cloudy-day" => "🌤",
        "partly-cloudy-night" => ""
    ];

    function __construct($service, $latitude, $longitude)
    {
        $this->service = $service;
        $this->fetchWeather($latitude, $longitude);
    }


    public function fetchWeather(string $latitude, string $longitude)
    {
        $this->service->setLocation($latitude, $longitude);
        $weatherJSON = $this->service->fetchWeather();
        $this->latitude = $weatherJSON["latitude"];
        $this->longitude = $weatherJSON["longitude"];
        $this->currently = (object) $weatherJSON["currently"];


        $this->daily = (object) $weatherJSON["daily"];

        $data = $this->daily->data;
        $this->daily->data = [];
        foreach ($data as $key => $day) {
            $this->daily->data["day$key"] = (object) $day;
        }
        $iconName = $this->currently->icon;
        $this->currently->icon = $this->icons[$iconName];
    }


    public function getData() : object
    {
        return (object)[
            "latitude" => strval($this->latitude),
            "longitude" => strval($this->longitude),
            "currently" => $this->currently,
            "daily" => $this->daily
        ];
    }


}
