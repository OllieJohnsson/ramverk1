<?php
namespace Oliver;

/**
 *
 */
trait ValidateIpTrait
{
    private $ipAddress;
    private $type;
    private $host;

    function validateIP(?string $ipAddress)
    {
        $this->ipAddress = $ipAddress;

        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->type = "IPv6";
        } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $this->type = "IPv4";
        }
        if ($this->type && gethostbyaddr($ipAddress) != $ipAddress) {
            $this->host = gethostbyaddr($ipAddress);
        }
    }
}
