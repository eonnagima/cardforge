<?php

require_once __DIR__."/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$pathToSSL = __DIR__."/BaltimoreCyberTrustRoot.crt.pem";
$options =[
    PDO::MYSQL_ATTR_SSL_CA => $pathToSSL
];

//Database configuration
// const CONFIG = [
//     "db" => [
//         "user"      => $_ENV['cardforgeDbUser'],
//         "password"  => $_ENV['cardforgeDbPassword'],
//         "host"      => $_ENV['cardforgeDbHost'],
//         "dbname"    => "cardforge",
//     ]
// ];

const CONFIG = [
    "db" => [
        "user"      => "root",
        "password"  => "",
        "host"      => "localhost",
        "dbname"    => "cardforge",
    ]
];

//Cloudinary API configuration
use Cloudinary\Configuration\Configuration;

$config = Configuration::instance();
$config->cloud->cloudName = $_ENV['cloudinaryCloudname'];
$config->cloud->apiKey = $_ENV['cloudinaryApiKey'];
$config->cloud->apiSecret = $_ENV['cloudinaryApiSecret'];
$config->url->secure = true; 