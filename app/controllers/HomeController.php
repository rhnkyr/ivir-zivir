<?php
/**
 *
 * Sayfa ilk açıldığında sayfaya gelecek içerik buradan ayarlanıyor
 *
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 11.11.2013
 * Time: 17:54
 */
namespace Controllers;
use App\Helpers\Collections;

class HomeController
{
    public function __construct()
    {
        $this->app   = \Slim\Slim::getInstance();
        $this->mongo = $this->app->mongo;
        $this->redis = $this->app->redis;
    }

    public function index()
    {
        if ($this->redis->load("deneme") === false) {
            $data = $this->mongo->limit(5)->get(Collections::PLACES);
            $this->redis->save("deneme", $data, '10');
        }
        $data["res"] = $this->redis->load("deneme"); //$this->mongo->limit(5)->get(Collections::PLACES);
        $this->app->render('app/index.html.twig', $data);
    }

    public function getLastPlaces($limit = 5)
    {
        $data["res"] = $this->mongo->limit($limit)->get(Collections::PLACES);
        $this->app->render('app/index.html.twig', $data);
    }
} 