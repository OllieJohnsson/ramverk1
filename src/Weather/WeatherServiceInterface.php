<?php
namespace Oliver\Weather;

/**
 *
 */
interface WeatherServiceInterface
{
    function configure(array $config);
    function forecast(array $coordinates) : array;
    function history(array $coordinates, int $daysBack) : array;
}
