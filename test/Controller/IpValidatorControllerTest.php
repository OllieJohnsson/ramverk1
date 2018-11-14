<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\IpValidatorController;

/**
 * Test the SampleController.
 */
class IpValidatorControllerTest extends TestCase
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
        $this->controller = new IpValidatorController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }


    /**
     * Test the route "index" with IPv4-address.
     */
    public function testIndexActionIpv4()
    {
        $this->di->get("request")->setGlobals(["post" => ["ipAddress" => "1.1.1.1"]]);
        $this->controller->indexAction();
        $res = $this->controller->getMessage();
        $this->assertContains("IPv4-adress", $res);
    }

    /**
     * Test the route "index" with IPv6-address.
     */
    public function testIndexActionIpv6()
    {
        $this->di->get("request")->setGlobals(["post" => ["ipAddress" => "fe80::200:f8ff:fe21:67cf"]]);
        $this->controller->indexAction();
        $res = $this->controller->getMessage();
        $this->assertContains("IPv6-adress", $res);
    }

    /**
     * Test the route "index" with invalid IP-address.
     */
    public function testIndexActionInvalid()
    {
        $this->controller->indexAction("1.apa.1.1");
        $res = $this->controller->getMessage();
        $this->assertContains("inte en giltig IP-adress", $res);
    }
}
