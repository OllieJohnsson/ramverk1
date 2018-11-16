<?php
namespace Oliver\Commons;



/**
 *
 */
trait IpLocationTrait
{
    private $config;

    public function __construct()
    {
        $configString = file_get_contents(__DIR__."/../../config/ipstack/api.json");
        $this->config = json_decode($configString, true)[0];
    }

    public function locateIpAddress(string $ipAddress)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config["baseUrl"]."/".$ipAddress."?access_key=".$this->config["token"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
}
