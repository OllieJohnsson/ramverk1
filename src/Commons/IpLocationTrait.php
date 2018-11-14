<?php
namespace Oliver\Commons;



/**
 *
 */
trait IpLocationTrait
{
    private $baseUrl = "http://api.ipstack.com";
    private $token = "64928d0784fc6e433896e32a1ff26ca0";

    public function locateIpAddress(string $ipAddress)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl."/".$ipAddress."?access_key=".$this->token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
}
