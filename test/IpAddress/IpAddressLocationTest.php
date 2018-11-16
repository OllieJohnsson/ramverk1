<?php
namespace Oliver\IpAddress;

use PHPUnit\Framework\TestCase;
use Oliver\IpAddress\IpAddressLocation;

/**
 * Example test class.
 */
class IpAddressLocationTest extends TestCase
{

    protected $ipAddress;

    public function setUp()
    {
        $this->ipAddress = new IpAddressLocation("1.1.1.1");
    }

    /**
     * Assert correct type
     */
    public function testLocate()
    {
        $this->ipAddress->locate("1.1.1.1");
        $res = $this->ipAddress->getIp()->country_name;
        $this->assertEquals($res, "Australia");
    }


    public function testGetIp()
    {
        $this->ipAddress->validate("1.1.1.1");

        $ip = $this->ipAddress->getIp()->ip;
        $this->assertEquals($ip, "1.1.1.1");

        $type = $this->ipAddress->getIp()->type;
        $this->assertEquals($type, "IPv4");

        $host = $this->ipAddress->getIp()->host;
        $this->assertEquals($host, "one.one.one.one");
    }
}
