<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
        [
            "text" => "IP-validator",
            "url" => "ip-validator",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "IP-validator",
                        "url" => "ip-validator",
                        "title" => "IP-validator",
                    ],
                    [
                        "text" => "IP-validator rest API",
                        "url" => "ip-validator/rest-api",
                        "title" => "IP-validator rest API",
                    ],
                ],
            ],
        ],
        [
            "text" => "IP-locator",
            "url" => "ip-location",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "IP-location",
                        "url" => "ip-location",
                        "title" => "IP-location",
                    ],
                    [
                        "text" => "IP-location rest API",
                        "url" => "ip-location/rest-api",
                        "title" => "IP-location rest API",
                    ],
                ],
            ],
        ],
    ],
];
