<?php
namespace Oliver\IpAddress;

/**
 *
 */
trait ValidateIpTrait
{

    function validateIP(?string $ipAddress) : object
    {
        $ipObject = (object)[
            "address" => $ipAddress,
            "type" => null,
            "host" => null
        ];

        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $ipObject->type = "IPv6";
        } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $ipObject->type = "IPv4";
        }
        if ($ipObject->type && gethostbyaddr($ipAddress) != $ipAddress) {
            $ipObject->host = gethostbyaddr($ipAddress);
        }
        return $ipObject;
    }
}
