<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\IpLocationController;

/**
 * Test the SampleController.
 */
class IpLocationControllerTest extends TestCase
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
        $this->controller = new IpLocationController();
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

        $res = $this->controller->getIp()->getIp()->type;
        $this->assertEquals("IPv4", $res);
    }

    /**
     * Test the route "index" with IPv6-address.
     */
    public function testIndexActionIpv6()
    {
        $this->di->get("request")->setGlobals(["post" => ["ipAddress" => "fe80::200:f8ff:fe21:67cf"]]);
        $this->controller->indexAction();

        $res = $this->controller->getIp()->getIp()->type;
        $this->assertEquals("IPv6", $res);
    }

    /**
     * Test the route "index" with invalid IP-address.
     */
    public function testIndexActionInvalid()
    {
        $this->di->get("request")->setGlobals(["post" => ["ipAddress" => "1.apa.1.1"]]);
        $this->controller->indexAction();

        $type = $this->controller->getIp()->getIp()->type;
        $map_link = $this->controller->getIp()->getIp()->map_link;
        $this->assertNull($type);
        $this->assertNull($map_link);
    }
}
