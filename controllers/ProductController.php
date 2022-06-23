<?php

  namespace app\controllers;
  use app\Router;

  class ProductController{
    public static function index(Router $router){
      $router->render_view("products/index");
    }
    public static function create($router){
      $router->render_view("products/create");
    }
    public static function update($router){
      $router->render_view("products/update");
    }
    public static function delete($router){
      echo $router->render_view("products/index");
    }
  }