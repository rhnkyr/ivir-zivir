<?php

/**
 * Session check for other pages
 */
$sessionCheck = function ($key, $redirect) {
    return function () use ($key, $redirect) {
        if (!isset($_SESSION [$key])) {
            $app = \Slim\Slim::getInstance();
            $app->redirect('/' . $redirect);
        }
    };
};