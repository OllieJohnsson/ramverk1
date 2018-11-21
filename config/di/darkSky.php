<?php
/**
 * Configuration file for weather service.
 */
return [
    // Services to add to the container.
    "services" => [
        "darkSky" => [
            // "active" => true,
            "shared" => false,
            "callback" => function () {
                $darkSky = new \Oliver\Weather\DarkSky();
                $darkSky->setDI($this);

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("api");

                $darkSky->configure($config["config"]["darksky"]);

                return $darkSky;
            }
        ],
    ],
];
