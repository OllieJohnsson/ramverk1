<?php
namespace Oliver\IpAddress;

use PHPUnit\Framework\TestCase;
use Oliver\IpAddress\IpAddress;

/**
 * Example test class.
 */
class IpAddressExceptionTest extends TestCase
{

    protected $ipAddress;

    public function setUp()
    {
        $this->ipAddress = new IpAddress("1.1.1.1");
    }

    /**
     * Assert that validate() throws correct exception
     */
    public function testValidateInvalid()
    {
        $this->expectException(\Oliver\IpAddress\Exception\InvalidIpException::class);
        $this->ipAddress->validate("2.apa.4.5");
    }

    /**
     * Assert that validate() throws correct exception
     */
    public function testValidateNonExistent()
    {
        $this->expectException(\Oliver\IpAddress\Exception\NonExistentIpException::class);
        $this->ipAddress->validate("0.0.0.0");
    }
}
