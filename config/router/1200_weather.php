<?php


return [
    "mount" => "weather",
    "routes" => [
        [
            "info" => "Väder",
            "path" => "",
            "handler" => "\Oliver\Controller\WeatherController",
        ],
        [
            "info" => "Väder rest API",
            "mount" => "rest-api",
            "handler" => "\Oliver\Controller\WeatherJsonController",
        ],
    ]
];
