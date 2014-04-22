<?php

// Panel Group
$app->group(
    '/user', //daha sonra kullanici diye de değişebilir.
    //$sessionCheck("user", ""),
    function () use ($app) {

    	$app->get("/edit_profile", function () {
            echo (isset($_SESSION['slim.flash']['msg'])) ? customMsg($_SESSION['slim.flash']['msg']) : '';
            echo "<br>daha sonra hazırlanacak";
        });

        /*$app->get("/(:slug)", function ($slug) use ($cache) {

        });*/

        $app->get('/(:username)','\App\Controllers\UserController:getUserByUserName');
        
    });



