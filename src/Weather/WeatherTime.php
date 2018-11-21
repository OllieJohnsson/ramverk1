<?php

/**
 *
 */
class WeatherData
{
    private $time;
    private $summary;
    private $icon;

    function __construct(array $weatherJSON)
    {
        $this->time = $weatherJSON["time"];
        $this->time = $weatherJSON["summary"];
        $this->time = $weatherJSON["icon"];
    }

    public function getData()
    {
        return (object)[
            "time" => $this->time,
            "summary" => $this->summary,
            "icon" => $this->icon
        ];
    }


}
