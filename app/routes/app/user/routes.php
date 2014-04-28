<?php
// User Group
$app->group('/kullanici', /*$sessionCheck("user", "/"),*/ function () use ($app) {
    $app->get('/:user_name', '\Controllers\UserController:index')->name("user_profile");
    $app->post('/:user_name/arkadaslarim', '\Controllers\UserController:friends')->name("user_friends");
    $app->post('/:user_name/yorumlarim', '\Controllers\UserController:comments')->name("user_comments");
    $app->post('/:user_name/checkin', '\Controllers\UserController:checkins')->name("user_checkins");
    $app->post('/:user_name/begendiklerim', '\Controllers\UserController:favs')->name("user_favs");
    $app->post('/:user_name/puanladiklarim', '\Controllers\UserController:reviews')->name("user_reviews");
});



