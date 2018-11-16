<?php
namespace Oliver\IpAddress;

use PHPUnit\Framework\TestCase;
use Oliver\IpAddress\IpAddress;

/**
 * Example test class.
 */
class IpAddressTest extends TestCase
{

    protected $ipAddress;

    public function setUp()
    {
        $this->ipAddress = new IpAddress("1.1.1.1");
    }

    /**
     * Assert correct type
     */
    public function testValidate()
    {
        $this->ipAddress->validate("2.3.4.5");
        $this->assertEquals($this->ipAddress->getIp()->type, "IPv4");
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
