<?php
/**
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 27.02.2014
 * Time: 01:33
 */

// Named array of connection parameters:
$client = new Predis\Client(array(
        'scheme'      => 'tcp',
        'host'        => '127.0.0.1',
        'port'        => 6379,
        'connections' => array(
            'tcp'  => 'Predis\Connection\PhpiredisStreamConnection', // PHP streams
            'unix' => 'Predis\Connection\PhpiredisConnection', // ext-socket
        )
    )
);