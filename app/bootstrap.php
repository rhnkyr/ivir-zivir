<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
//////// composer init ////////
require_once 'vendor/autoload.php';
///////////////////////////////
//////// Pre - Configs /////////////
require_once 'config/log.php'; //Loglama
///////////////////////////////
//region SLIM
//////// Slim Init ////////////
$app = new \Slim\Slim(array(
    'mode'           => 'development', //todo:serverda live olunca production yapılacak
    'debug'          => true, //todo : live olunca false olacak ki sadece loglayacak
    'view'           => new \Slim\Views\Twig(),
    'templates.path' => SS_APP_PATH . '/templates',
    'log.enabled'    => true, //log aktif
    'log.writer'     => $logger //Log yazıcısı monolog
));
/*$app->error(function (\Exception $e) use ($app) { //monolog bunu halleder gibi
    $app->render('error.php', array("e" => $e));
});*/
/*$app->notFound(function () use ($app) { // 404 sayfasına yönlendirir
    $app->render('app/404');
});*/
//////// Twig extensions Init ////////////https://github.com/codeguy/Slim-Views
$view = $app->view();
//twig in kendi cache sistemi data değiştiğinde otomatik refreshleniyormuş
//yani memcached süresi dolduğunda yeni data gelmişse yansıyacak denemeli???
$view->parserOptions    = array( //http://twig.sensiolabs.org/doc/api.html#environment-options
    'charset'     => 'utf-8',
    'cache'       => SS_APP_PATH . '/templates/cache',
    'auto_reload' => true //data değiştiğinde template yeniden gösterir
);
$view->parserExtensions = array(new \Slim\Views\TwigExtension());
$twig                   = $app->view()->getEnvironment();
///////////////////////////////
//endregion
/////// Assets Manager ///////
$assets         = New \Spassets\Spassets();
$assets->minify = true;
//////////////////////////////
require_once 'helpers/collections.php'; //Collectionlar için yardımcı
require_once 'helpers/crudtypes.php'; //Crud Typelar için yardımcı
require_once 'helpers/gump.php'; //Form validation
require_once 'helpers/mail_helper.php'; //Mailing Helper
//////// App Based Configs /////////////
require_once 'config/app.php'; //Tüm site bilgilerini tutat
require_once 'config/db.php'; //DB bilgilerini tutar
require_once 'config/redis.php'; //Redis
/////////////////////////////////
require_once 'helpers/filters.php'; //router içinde kullanılan filtreler
require_once 'helpers/tools.php'; //bazı gerekli foksiyonlar
require_once 'helpers/controllers.php'; //bazı gerekli foksiyonlar
require_once 'helpers/RedisCache.php'; //bazı gerekli foksiyonlar
/////////////////////////////////
////////// DI kısmı //////////////
$app->twig   = $twig; //Twig global
$app->mongo  = $mongo; //App a mongo db yi global variable olarak tanımlıyoruz
$app->redis  = new RedisCache($client); //Redis
$app->assets = $assets; //assets manager
//////// Helpers ////////////////
//////// Routes ////////////////
//require_once 'routes/admin/routes.php'; //Admin panel routeları
require_once 'routes/app/place/routes.php'; //Site Mekan routeları
require_once 'routes/app/user/routes.php'; //Site Kullanıcı routeları
require_once 'routes/app/routes.php'; //Site routeları




