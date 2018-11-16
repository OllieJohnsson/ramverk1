<?php


return [
    "mount" => "ip-location",
    "routes" => [
        [
            "info" => "IP-location",
            "path" => "",
            "handler" => "\Oliver\Controller\IpLocationController",
        ],
        [
            "info" => "IP-location rest API",
            "mount" => "rest-api",
            "handler" => "\Oliver\Controller\IpLocationJsonController",
        ],
    ]
];
