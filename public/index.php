<?php
define('SS_ROOT', dirname(__DIR__));
define('SS_APP_PATH', SS_ROOT . '/app');

//-- Next, bootstrap it
require_once SS_APP_PATH . '/bootstrap.php';

//-- RUN!
$app->run();