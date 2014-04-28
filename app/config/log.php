<?php
/**
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 21.11.2013
 * Time: 02:38
 */
//////// Monolog Logger ///////Loglama için
$logger = new \Flynsarmy\SlimMonolog\Log\MonologWriter(array(
    'name'     => "MekanlarLogger",
    'handlers' => array(
        new \Monolog\Handler\StreamHandler(SS_APP_PATH . '/logs/' . date('Y-m-d') . '.log'), //log klasörüne atar
        new \Monolog\Handler\FirePHPHandler(), //Firefoxtaki firephp eklentisinden görünsün diye
        new \Monolog\Handler\ChromePHPHandler() //Chromedaki firephp eklentisinden görünsün diye
    )
));
///////////////////////////////