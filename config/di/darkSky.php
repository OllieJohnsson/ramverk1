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
                $curl = new \Oliver\Curl\Curl();
                $darkSky = new \Oliver\DarkSky\DarkSky($curl);
                $darkSky->setDI($this);

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("darkSky/config.php");
                $darkSky->configure($config["config"]);
                return $darkSky;
            }
        ],
    ],
];
