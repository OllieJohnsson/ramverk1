<?php


return [
    "mount" => "ip-validator",
    "routes" => [
        [
            "info" => "IP-validator",
            "path" => "",
            "handler" => "\Oliver\Controller\IpValidatorController",
        ],
        [
            "info" => "IP-validator rest API",
            "mount" => "rest-api",
            "handler" => "\Oliver\Controller\IpValidatorJsonController",
        ],
    ]
];
