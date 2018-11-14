<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\IpValidatorJsonController;

/**
 * Test the SampleJsonController.
 */
class IpValidatorJsonControllerTest extends TestCase
{

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
        $this->controller = new IpValidatorJsonController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(Anax\Response\ResponseUtility::class, $res);
    }

    /**
     * Test the route "ipActionGet".
     */
    public function testIpActionPost()
    {
        $this->di->get("request")->setGlobals(["post" => ["ipAddress" => "1.1.1.1"]]);
        $res = $this->controller->ipActionPost();
        $this->assertEquals("ip-validator/rest-api/ip/1.1.1.1", $res);
    }

    /**
     * Test the route "ipActionGet".
     */
    public function testIpActionGet()
    {
        $res = $this->controller->ipActionGet("255.255.255.255");
        $this->assertInternalType("array", $res);
        $this->assertEquals("IPv4", $res[0]["type"]);

        $res = $this->controller->ipActionGet("fe80::200:f8ff:fe21:67cf");
        $this->assertInternalType("array", $res);
        $this->assertEquals("IPv6", $res[0]["type"]);
    }

}
