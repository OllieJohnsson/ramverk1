<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\WeatherController;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }


    /**
     * Test the route "index" with GET.
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet()->getBody();
        $this->assertContains("Väder", $res);
    }

    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPost()
    {
        $this->di->get("request")->setGlobals(["post" => ["lat" => "12", "long" => "12"]]);
        $this->controller->indexActionPost();

        $this->assertEquals($this->controller->getWeather()->getData()->latitude, "12");
        $this->assertEquals($this->controller->getWeather()->getData()->longitude, "12");
    }


    /**
     * Test the error message if latitude has wrong format.
     */
    public function testLatitudeFormat()
    {
        $this->di->get("request")->setGlobals(["post" => ["lat" => "fel", "long" => "123"]]);
        $this->controller->indexActionPost();
        $this->assertEquals($this->controller->getMessage(), "Latitud hade inte rätt format");
    }

    /**
     * Test the error message if longitude has wrong format.
     */
    public function testLongitudeFormat()
    {
        $this->di->get("request")->setGlobals(["post" => ["lat" => "12", "long" => "lala"]]);
        $this->controller->indexActionPost();
        $this->assertEquals($this->controller->getMessage(), "Longitud hade inte rätt format");
    }

    /**
     * Test the error message if coordinates are invalid.
     */
    public function testInvalidCoordinates()
    {
        $this->di->get("request")->setGlobals(["post" => ["lat" => "1000", "long" => "1000"]]);
        $this->controller->indexActionPost();
        $this->assertEquals($this->controller->getMessage(), "Platsen hittades inte.<br>Latitude: 1000<br>Longitude: 1000");
    }
}
