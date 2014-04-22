<?php
//https://gist.github.com/calmdev/da147f3e63b27a0f282d
namespace App\Controllers;
use App\Collections\Collections;

class TryController
{

    public function __construct()
    {
        $this->app = \Slim\Slim::getInstance();
        $this->mongo = $this->app->mongo;
    }

    public function index()
    {
        //$this->app->render('home');
        echo "Done";
    }

    public function sayHello($name)
    {
        //$this->app->render('home');
        //echo "Done : " . $name;
        print_r($this->mongo->limit(5)->get(Collections::PLACES));
    }
}