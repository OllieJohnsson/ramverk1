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
        $res = $this->controller->indexActionGet();
        $this->assertContains("Väder", $res->getBody());
    }

    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPost()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "51.50069,-0.12458", "option" => "forecast"]]);
        $res = $this->controller->indexActionPost();
        $coordinates = $this->di->get("request")->getPost("coordinates");
        $option = $this->di->get("request")->getPost("option");

        $this->assertContains("Europe/London", $res->getBody());
    }

    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPostFail()
    {
        $this->di->get("request")->setGlobals(["post" => ["coordinates" => "51.50069", "option" => "forecast"]]);
        $res = $this->controller->indexActionPost();
        $coordinates = $this->di->get("request")->getPost("coordinates");
        $option = $this->di->get("request")->getPost("option");

        $this->assertContains("fel formaterat", $res->getBody());
    }



}
