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
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "12,12"]]);
        $this->controller->indexActionPost();
        $coordinateString = $this->di->get("request")->getPost("coordinates");

        $this->assertEquals($this->controller->getWeather()->fetchWeather($coordinateString)[0]->latitude, "12");
        $this->assertEquals($this->controller->getWeather()->fetchWeather($coordinateString)[0]->longitude, "12");
    }


    /**
     * Test the error message if latitude has wrong format.
     */
    public function testLatitudeFormat()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "fel,123"]]);
        $this->controller->indexActionPost();

        $this->assertEquals($this->controller->getMessage(), "Latituden <b>fel</b> har fel format.");
    }

    /**
     * Test the error message if longitude has wrong format.
     */
    public function testLongitudeFormat()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "12,lala"]]);
        $this->controller->indexActionPost();
        $this->assertEquals($this->controller->getMessage(), "Longituden <b>lala</b> har fel format.");
    }

    /**
     * Test the error message if coordinates are invalid.
     */
    public function testInvalidCoordinates()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "1000,1000"]]);
        $this->controller->indexActionPost();
        $this->assertEquals($this->controller->getMessage(), "Platsen hittades inte.<br>Latitud: <b>1000</b><br>Longitud: <b>1000</b>");
    }

    /**
     * Test the error message if coordinates are in bad format.
     */
    public function testBadFormatCoordinates()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "1000"]]);
        $this->controller->indexActionPost();
        $this->assertEquals($this->controller->getMessage(), "Värdet var fel formaterat!");
    }


}
