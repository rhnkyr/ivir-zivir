<?php

/*$app->get('/', function () use ($app, $cache) {
    $app->getLog()->info('hello world');//php debug bar deneme
    //$app->getLog()->info("Hem");

    /*$data = array();

    if (!$cache->has("last")) {
        $d = $pimple['HomeController']->getLastPlaces(15);
        $cache->set("last", $d, 60);//1 dk
    }*/
    //memcache check ve ekleme

    //41.065601, 28.997505 mecidiyeköy
    //Eski Ali samiyenin 20 m çevresindeki restoranlar.
    /*$data["res"] = $pimple['mongo']->whereNear("place_loc", array(floatval(28.9975), floatval(41.065601)), 20)
        ->where("place_category.cat_slug", "restoran")
        ->limit(5)->get('places');*/

    //print_r($data);
    //ile ilçeye ve keyword e göre arama
    //$data["res"] = $qb->where("place_province.province_slug", 'sisli')
    //    ->where("place_city.city_slug", "istanbul")
    //    ->whereLike("place_title", "tepe")
    //    ->get("places");
    //

    /*$data["time"] = $cache->get("time");
    print_r($data);*/
    //$app->render('app/index', $data);

    //print_r($pimple['UserController']->getUser("526afaf44b85f5b28bbb05b4"));
    //print_r($pimple['UserController']->getUserFavs("526afaf44b85f5b28bbb05b4"));
    //print_r($pimple['UserController']->getUserWishList("526afaf44b85f5b28bbb05b4"));

    //print_r($pimple['PlaceController']->getPlace("52799120c83f4e8011000057"));
    //print_r($pimple['HomeController']->getLastPlaces(10));

    /*$comment = array(
        "user_id"  => "526afaf44b85f5b28bbb05b4",
        "place_id" => "52799120c83f4e8011000057",
        "content"  => "Hembele"
    );
    print_r($pimple['PlaceController']->addCommentToPlace($comment));*/

    //echo $pimple['PlaceController']->likeCountOfPlace("5275a2d0ba736a7f69a7b88f");

    //echo $pimple['PlaceController']->addPageViewToPlace("5275a2d0ba736a7f69a7b88f");
    //if (isset($_SESSION['user'])) echo $_SESSION['user']['name'];
    //echo '<pre>';
    //print_r($pimple['UserController']->getUserComments("526afaf44b85f5b28bbb05b4"));

//});
$app->get('/','\Controllers\HomeController:index');


$app->post("/confirm",function() use ($app){
    $twig = $app->view()->getEnvironment();    // Twig_Environment
    $generator = new Mail_Helper($twig); // Can be in a DIC

    echo $generator->getMessage('confirm', array(
        'to' => "a@b.com"
    ));
});

//$app->get("/control/:name", '\App\Controllers\TryController:sayHello');

$app->get("/clear", function (){

});
//parantez için opsiyonel ama get i yada postu öyle de kabul eder. Diğer türlü slashlı gelirse hata fırlatıyor!
//Her iki method için (POST, GET) map fonksiyonu kullanabilirsin
/*$app->map("/register(/)", function () use ( $app) {
    $pimple['UserController']->register();
})->via('GET', 'POST');

$app->map("/activation(/:user_id(/:ac_key))(/)", function ($user_id=FALSE,$ac_key=FALSE) use ( $app) {
    $pimple['UserController']->activation($user_id,$ac_key);
})->via('GET', 'POST');

$app->map("/login(/)", function () use ( $app) {
    $pimple['UserController']->login();
})->via('GET', 'POST');

$app->map("/logout(/)", function () use ($app) {
    unset($_SESSION['user']);
    $app->redirect(BASE);
})->via('GET');

$app->map("/forgotten_password(/)", function () use ($app) {
    $pimple['UserController']->forgotten_password();
})->via('GET','POST');

$app->map("/reset_passwd/:user_id/:fp_key(/)", function ($user_id,$fp_key) use ( $app) {
    $pimple['UserController']->reset_passwd($user_id,$fp_key);
})->via('GET', 'POST');*/
