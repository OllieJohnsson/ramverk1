<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\WeatherJSONController;

/**
 * Test the SampleController.
 */
class WeatherJSONControllerTest extends TestCase
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
        $this->controller = new WeatherJSONController();
        $this->controller->setDI($this->di);
    }


    /**
     * Test the route "index" with GET.
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet()->getBody();
        $this->assertContains("Väder (REST API)", $res);
    }

    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPost()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "12,12"]]);
        $res = $this->controller->indexActionPost();

        $this->assertEquals($res[0][0]["latitude"], "12");
        $this->assertEquals($res[0][0]["longitude"], "12");
    }


    /**
     * Test the error message if latitude has wrong format.
     */
    public function testLatitudeFormat()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "fel,123"]]);
        $res = $this->controller->indexActionPost();
        $this->assertEquals($res[0]["error"], "Latituden <b>fel</b> har fel format.");
    }

    /**
     * Test the error message if longitude has wrong format.
     */
    public function testLongitudeFormat()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "12,lala"]]);
        $res = $this->controller->indexActionPost();
        $this->assertEquals($res[0]["error"], "Longituden <b>lala</b> har fel format.");
    }

    /**
     * Test the error message if coordinates are invalid.
     */
    public function testInvalidCoordinates()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "1000,1000"]]);
        $res = $this->controller->indexActionPost();
        $this->assertEquals($res[0]["error"], "Platsen hittades inte.<br>Latitud: <b>1000</b><br>Longitud: <b>1000</b>");
    }
}
