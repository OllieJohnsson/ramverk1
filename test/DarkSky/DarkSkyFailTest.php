<?php
use PHPUnit\Framework\TestCase;
use Anax\DI\DIFactoryConfig;
use Oliver\DarkSky\Exception\InvalidLocationException;

/**
 *
 */
class DarkSkyeFailTest extends TestCase
{
    protected $di;

    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di = $this->di;
    }

    public function testInvalidLocation()
    {
        $darkSky = $this->di->get("darkSky");
        $this->expectException(InvalidLocationException::class);
        $result = ["error" => "something"];
        $darkSky->validateResult($result);
    }

}
