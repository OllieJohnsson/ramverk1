<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Weather\Weather;
use Oliver\Weather\Exception\BadFormatException;

/**
 *
 */
class WeatherFailTest extends TestCase
{
    protected $di;
    private $weather;

    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di = $this->di;

        $darkSky = $this->di->get("darkSky");
        $this->weather = new Weather($darkSky);
    }

    public function testFetchWeatherBadFormat()
    {
        $this->expectException(BadFormatException::class);
        $this->weather->fetchWeather("1234", "forecast");
    }

    public function testFetchWeatherBadFormatLatitude()
    {
        $this->expectException(BadFormatException::class);
        $this->weather->fetchWeather("lalalal,33", "forecast");
    }

    public function testFetchWeatherBadFormatLongitude()
    {
        $this->expectException(BadFormatException::class);
        $this->weather->fetchWeather("44.52,jeee", "forecast");
    }
}
