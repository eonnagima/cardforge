<?php

require_once __DIR__."/vendor/autoload.php";

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    putenv('cloudinaryCloudname=' . $_ENV['cloudinaryCloudname']);
    putenv('cloudinaryApiKey=' . $_ENV['cloudinaryApiKey']);
    putenv('cloudinaryApiSecret=' . $_ENV['cloudinaryApiSecret']);
    putenv('cardforgeDbUser=' . $_ENV['cardforgeDbUser']);
    putenv('cardforgeDbPassword=' . $_ENV['cardforgeDbPassword']);
    putenv('cardforgeDbHost=' . $_ENV['cardforgeDbHost']);
}

$pathToSSL = __DIR__."/ssl/DigiCertGlobalRootCA.crt.pem";
$options = [PDO::MYSQL_ATTR_SSL_CA => $pathToSSL];

//Database configuration
$dbConfig = [
    "user"      => getenv('cardforgeDbUser'),
    "password"  => getenv('cardforgeDbPassword'),
    "host"      => getenv('cardforgeDbHost'),
    "dbname"    => "cardforgedb",
    "options"   => $options
];

//Cloudinary API configuration
use Cloudinary\Configuration\Configuration;

$config = Configuration::instance();
$config->cloud->cloudName = getenv('cloudinaryCloudname');
$config->cloud->apiKey = getenv('cloudinaryApiKey');
$config->cloud->apiSecret = getenv('cloudinaryApiSecret');
$config->url->secure = true; 