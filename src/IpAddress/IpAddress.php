<?php
namespace Oliver\IpAddress;

use Oliver\IpAddress\Exception\InvalidIpException;
use Oliver\IpAddress\Exception\NonExistentIpException;

/**
 *
 */
class IpAddress
{
    protected $config;

    protected $ipAddress;
    protected $type;
    protected $host;

    function __construct($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        $configString = file_get_contents(__DIR__."/../../config/ipstack/api.json");
        $this->config = json_decode($configString, true)[0];
    }

    public function validate(string $ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->type = "IPv6";
        } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $this->type = "IPv4";
        } else {
            throw new InvalidIpException("<b>{$ipAddress}</b> är inte en giltig IP-adress.");
        }

        if ($this->type && gethostbyaddr($ipAddress) != $ipAddress) {
            $this->host = gethostbyaddr($ipAddress);
        } else {
            throw new NonExistentIpException("<b>{$ipAddress}</b> finns inte.");
        }
        $this->ipAddress = $ipAddress;
        return $this;
    }

    public function getIp()
    {
        return (object)[
            "ip" => $this->ipAddress,
            "type" => $this->type,
            "host" => $this->host,
        ];
    }
}
