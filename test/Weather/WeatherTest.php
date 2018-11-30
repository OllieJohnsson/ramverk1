<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Weather\Weather;

/**
 *
 */
class WeatherTest extends TestCase
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

    public function testFetchWeatherForecast()
    {
        $res = $this->weather->fetchWeather("30,50", "forecast");
        $this->assertEquals($res["latitude"], "30");
        $this->assertEquals($res["longitude"], "50");
    }

    public function testFetchWeatherHistory()
    {
        $res = $this->weather->fetchWeather("44,20", "history");
        $this->assertEquals(count($res), 30);
    }
}
