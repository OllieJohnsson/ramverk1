<?php
namespace Oliver\IpAddress;

/**
 *
 */
class IpAddressLocation extends IpAddress
{
    protected $country_name;
    protected $country_flag_emoji;
    protected $region_name;
    protected $city;
    protected $latitude;
    protected $longitude;
    protected $map_link;

    function __construct(string $ipAddress)
    {
        parent::__construct($ipAddress);
    }

    public function locate(string $ipAddress)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config["baseUrl"]."/".$ipAddress."?access_key=".$this->config["token"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($res, true);

        $this->country_name = $json["country_name"];
        $this->country_flag_emoji = $json["location"]["country_flag_emoji"];
        $this->region_name = $json["region_name"];
        $this->city = $json["city"];
        $this->latitude = $json["latitude"];
        $this->longitude = $json["longitude"];

        if ($this->latitude && $this->longitude) {
            $this->map_link = "https://www.openstreetmap.org/?mlat={$this->latitude}&amp;mlon={$this->longitude}#map=18/{$this->latitude}/{$this->longitude}";
        }
    }

    public function getIp() : object
    {
        return (object)[
            "ip" => $this->ipAddress,
            "type" => $this->type,
            "host" => $this->host,
            "country_name" => $this->country_name,
            "country_flag_emoji" => $this->country_flag_emoji,
            "region_name" => $this->region_name,
            "city" => $this->city,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "map_link" => $this->map_link
        ];
    }

    public function getIpJson() : array
    {
        return [$this->getIp()];
    }
}
