<?php
namespace Oliver\Weather;

/**
 *
 */
interface WeatherServiceInterface
{
    function configure(array $config);
    function fetchWeather(array $coordinates) : array;
}
