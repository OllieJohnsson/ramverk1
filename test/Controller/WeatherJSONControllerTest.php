<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\WeatherJSONController;

/**
 * Test the SampleController.
 */
class WeatherJsonControllerTest extends TestCase
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
        $this->controller = new WeatherJsonController();
        $this->controller->setDI($this->di);
    }


    /**
     * Test the route "index" with GET.
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertContains("Väder (REST API)", $res->getBody());
    }

    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPost()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "12,12", "option" => "history"]]);
        $res = $this->controller->indexActionPost("12,12");
        $this->assertEquals($res, "weather/api/history/12,12");
    }


    /**
     * Test the route "history".
     */
    public function testHistoryActionGet()
    {
        $res = $this->controller->historyActionGet("13,55");
        $this->assertContains($res[0][0]["timezone"], "Asia/Aden");
    }

    /**
     * Test the that route "history" fails.
     */
    public function testHistoryActionGetFail()
    {
        $res = $this->controller->historyActionGet("1300");
        $this->assertArrayHasKey("error", $res[0]);
    }


    /**
     * Test the route "forecast".
     */
    public function testForecastActionGet()
    {
        $res = $this->controller->forecastActionGet("13,55");
        $this->assertContains($res[0]["timezone"], "Asia/Aden");
    }

    /**
     * Test the that route "forecast" fails.
     */
    public function testForecastActionGetFail()
    {
        $res = $this->controller->forecastActionGet("1300");
        $this->assertArrayHasKey("error", $res[0]);
    }
}
