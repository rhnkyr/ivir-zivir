<?php

if ($app->getMode() == "development") {
    define("HOST", "localhost");
    define("DBNAME", "deneme");
    define("USERNAME", "mekan_user");
    define("PASSWORD", "993248");
} else {
    define("HOST", "localhost");
    define("DBNAME", "deneme");
    define("USERNAME", "");
    define("PASSWORD", "");
}

$mongo = new \MongoQB\Builder(array('dsn' => 'mongodb://' . USERNAME . ':' . PASSWORD . '@' . HOST . ':27017/' . DBNAME));