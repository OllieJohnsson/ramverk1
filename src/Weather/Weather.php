<?php
namespace Oliver\Weather;

use Oliver\Weather\WeatherServiceInterface;
use Oliver\Weather\Exception\BadFormatException;

/**
 *
 */
class Weather
{
    private $service;

    function __construct(WeatherServiceInterface $service)
    {
        $this->service = $service;
    }

    public function parseCoordinates($coordinateString) : array
    {
        $values = explode(",", $coordinateString);

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

        $coordinates = ["lat" => $lat, "long" => $long];
        return $coordinates;
    }

    public function fetchWeather(string $coordinateString, string $option) : array
    {
        $coordinates = $this->parseCoordinates($coordinateString);

        if ($option == "history") {
            $weatherJSON = $this->service->history($coordinates, 30);
            return $weatherJSON;
        } else {
            $weatherJSON = $this->service->forecast($coordinates);
            return $weatherJSON[0];
        }
    }
}
