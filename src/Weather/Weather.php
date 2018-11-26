<?php
namespace Oliver\Weather;

use Oliver\Weather\Exception\BadFormatException;

/**
 *
 */
class Weather
{
    private $service;

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

    function __construct($service)
    {
        $this->service = $service;
    }


    public function parseCoordinates($coordinateString) : array
    {
        $coordinateStrings = explode(" ", $coordinateString);
        $coordinates = [];

        for ($i=0; $i < count($coordinateStrings); $i++) {

            $values = explode(",", $coordinateStrings[$i]);
            if (count($values) != 2) {
                throw new BadFormatException("Värdet var fel formaterat!");
            }

            $lat = $values[0];
            $long = $values[1];
            if (!floatval($lat)) {
                throw new BadFormatException("Latituden <b>$lat</b> har fel format.");
            }
            if (!floatval($long)) {
                throw new BadFormatException("Longituden <b>$long</b> har fel format.");
            }

            $coordinates[$i]["lat"] = explode(",", $coordinateStrings[$i])[0];
            $coordinates[$i]["long"] = explode(",", $coordinateStrings[$i])[1];
        }
        return $coordinates;
    }


    public function fetchWeather(string $coordinateString, bool $json = false) : array
    {
        $coordinates = $this->parseCoordinates($coordinateString);
        $weatherJSON = $this->service->fetchWeather($coordinates);

        if ($json) {
            return [$weatherJSON];
        }

        $locations = [];

        foreach ($weatherJSON as $key => $location) {
            $locations[] = (object) $location;
            $locations[$key]->daily = (object) $location["daily"];
            $locations[$key]->daily->icon = $this->icons[$locations[$key]->daily->icon];

            foreach ($locations[$key]->daily->data as $dataKey => $value) {
                $locations[$key]->daily->data[$dataKey] = (object) $value;
                $locations[$key]->daily->data[$dataKey]->icon = $this->icons[$locations[$key]->daily->data[$dataKey]->icon];
            }
        }
        return $locations;
    }
}
