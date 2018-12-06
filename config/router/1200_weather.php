<?php

return [
    "mount" => "weather",
    "routes" => [
        [
            "info" => "Väder",
            "method" => "get",
            "path" => "",
            "handler" => ["\Oliver\Controller\WeatherController", "indexActionGet"],
        ],
        [
            "info" => "Väder",
            "method" => "post",
            "path" => "",
            "handler" => ["\Oliver\Controller\WeatherController", "indexActionPost"],
        ],
        [
            "info" => "Väder rest API index",
            "method" => "get",
            "path" => "api",
            "handler" => ["\Oliver\Controller\WeatherJsonController", "indexActionGet"],
        ],
        [
            "info" => "Väder rest API index",
            "method" => "post",
            "path" => "api",
            "handler" => ["\Oliver\Controller\WeatherJsonController", "indexActionPost"],
        ],
        [
            "info" => "Väder rest API history",
            "method" => "get",
            "path" => "api/history/{coordinates}",
            "handler" => ["\Oliver\Controller\WeatherJsonController", "historyActionGet"],
        ],
        [
            "info" => "Väder rest API forecast",
            "method" => "get",
            "path" => "api/forecast/{coordinates}",
            "handler" => ["\Oliver\Controller\WeatherJsonController", "forecastActionGet"],
        ],
        [
            "info" => "Väder dokumentation",
            "method" => "get",
            "path" => "documentation",
            "handler" => "\Anax\Content\FileBasedContentController",
        ],
    ]
];
