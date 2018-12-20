<?php
/**
 * Config file for Database.
 *
 * Example for MySQL.
 *  "dsn" => "mysql:host=localhost;dbname=test;",
 *  "username" => "test",
 *  "password" => "test",
 *  "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
 *
 * Example for SQLite.
 *  "dsn" => "sqlite:memory::",
 *
 */
// return [
//     // "dsn"             => "mysql:" . ANAX_INSTALL_PATH . "/data/db.sql",
//     "dsn" => "mysql:host=localhost;dbname=anaxdb;",
//     "username"        => "user",
//     "password"        => "pass",
//     "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
//     "fetch_mode"      => \PDO::FETCH_OBJ,
//     "table_prefix"    => null,
//     "session_key"     => "Anax\Database",
//
//     // True to be very verbose during development
//     "verbose"         => null,
//
//     // True to be verbose on connection failed
//     "debug_connect"   => false,
// ];


$serverName = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null;

if ($serverName === "www.student.bth.se") {
    return [
        "dsn"             => "mysql:host=blu-ray.student.bth.se;dbname=oljo17;",
        "username"        => "oljo17",
        "password"        => "cfDsXC2yfPwx",
        "driver_options"  => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ],
        "fetch_mode"      => \PDO::FETCH_OBJ,
        "table_prefix"    => null,
        "session_key"     => "Anax\Database",

        // True to be very verbose during development
        "verbose"         => null,

        // True to be verbose on connection failed
        "debug_connect"   => false,

        "mysql"           => "/usr/bin/mysql"
    ];
}


return [
    "dsn"             => "mysql:host=127.0.0.1;dbname=anaxdb;",
    "username"        => "user",
    "password"        => "pass",
    "driver_options"  => [
        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
    ],
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",

    // True to be very verbose during development
    "verbose"         => null,

    // True to be verbose on connection failed
    "debug_connect"   => true,
    "mysql"           => "/usr/local/mysql/bin/mysql"
];
