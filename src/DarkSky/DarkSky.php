<?php
namespace Oliver\DarkSky;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Oliver\Weather\WeatherServiceInterface;
use Oliver\DarkSky\Exception\InvalidLocationException;

use Oliver\Curl\CurlInterface;


/**
 *
 */
class DarkSky implements ContainerInjectableInterface, WeatherServiceInterface
{
    use ContainerInjectableTrait;

    private $baseUrl;
    private $apiKey;
    private $curl;
    private $coordinates;

    private $icons = [
        "clear-day" => "☀️",
        "clear-night" => "🌝",
        "rain" => "🌧",
        "snow" => "❄️",
        "sleet" => "🌨",
        "wind" => "💨",
        "fog" => "🌫",
        "cloudy" => "☁️",
        "partly-cloudy-day" => "🌤",
        "partly-cloudy-night" => ""
    ];

    public function __construct(CurlInterface $curl)
    {
        $this->curl = $curl;
    }

    public function configure(array $config)
    {
        $this->baseUrl = $config["baseUrl"];
        $this->apiKey = $config["apiKey"];
    }

    public function formatDate(int $daysBack) : string
    {
        $day = time() - ($daysBack * 24 * 60 * 60);
        $date = (date("Y-m-dT12:00:00", $day));
        $date = str_replace("U", "", $date);
        $date = str_replace("C", "", $date);
        return $date;
    }

    public function addIcons($daily) : array
    {
        if (array_key_exists("icon", $daily)) {
            $daily["icon"] = $this->icons[$daily["icon"]];
        }
        $data = [];
        foreach ($daily["data"] as $key => $day) {
            $day["icon"] = $this->icons[$day["icon"]];
            $data[] = $day;
        }
        $daily["data"] = $data;
        return $daily;
    }

    public function validateResult($result)
    {
        if (array_key_exists("error", $result)) {
            throw new InvalidLocationException("Platsen hittades inte.<br>Latitud: <b>{$this->coordinates['lat']}</b><br>Longitud: <b>{$this->coordinates['lat']}</b>");
        }
    }

    public function history($coordinates, $daysBack) : array
    {
        $this->coordinates = $coordinates;
        $urls = [];

        for ($i=0; $i < $daysBack; $i++) {
            $date = $this->formatDate($i);
            $urls[] = "$this->baseUrl/$this->apiKey/{$coordinates['lat']},{$coordinates['long']},$date?units=si&lang=sv";
        }

        $result = $this->curl->fetchData($urls);

        foreach ($result as $key => $day) {
            $this->validateResult($day);
            $result[$key]["daily"] = $this->addIcons($day["daily"]);
        }
        return $result;
    }


    public function forecast($coordinates) : array
    {
        $this->coordinates = $coordinates;
        $url = "$this->baseUrl/$this->apiKey/{$coordinates['lat']},{$coordinates['long']}?units=si&lang=sv";
        $result = $this->curl->fetchData([$url]);

        foreach ($result as $key => $day) {
            $this->validateResult($day);
            $result[$key]["daily"] = $this->addIcons($day["daily"]);
        }
        return $result;
    }
}
