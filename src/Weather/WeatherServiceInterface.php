<?php
namespace Oliver\Weather;

/**
 *
 */
interface WeatherServiceInterface
{
    function configure(array $config);
    function setLocation($lat, $long);
    function fetchWeather();
}
