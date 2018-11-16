<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Controller\IpLocationJsonController;

/**
 * Test the SampleJsonController.
 */
class IpLocationJsonControllerTest extends TestCase
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
        $this->controller = new IpLocationJsonController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test that the page contains the users ip-address.
     */
    public function testIndexAction()
    {
        $myIp = $this->controller->getMyIp();
        $res = $this->controller->indexAction()->getBody();

        $this->assertContains($myIp, $res);
    }

    /**
     * Test the route "ipActionPost".
     */
    public function testIpActionPost()
    {
        $this->di->get("request")->setGlobals(["post" => ["ipAddress" => "1.1.1.1"]]);
        $res = $this->controller->ipActionPost();
        $this->assertEquals("ip-location/rest-api/ip/1.1.1.1", $res);
    }

    /**
     * Test the route "ipActionGet".
     */
    public function testIpActionGet()
    {

        $this->controller->ipActionGet("255.255.255.255");
        $type = $this->controller->getIp()->getIp()->type;
        $this->assertEquals("IPv4", $type);

        $res = $this->controller->ipActionGet("255.apa.255.255");
        $this->assertTrue(array_key_exists("error", $res[0]));
    }

}
