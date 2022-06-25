<?php

  namespace app\controllers;

use app\models\Product;
use app\Router;

  class ProductController{
    public static function index(Router $router){
      $search_string = $_GET["search"] ?? "";
      $products = $router->db->get_products($search_string);
      $router->render_view("products/index", [
        'products' => $products,
        'search_string' => $search_string
      ]);
    }

    public static function create(Router $router){
      $errors = [];
      $product_data = [
        "title" => "",
        "description" => "",
        "image" => "",
        "price" => 0,
      ];

      if($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_data["title"] = $_POST["title"];
        $product_data["description"] = $_POST["description"];
        $product_data["price"] = (int)$_POST["price"];
        $product_data["image_file"] = $_FILES["image"] ?? null;

        $product = new Product();
        $product->load($product_data);
        $errors = $product->save();
        if(empty($errors)){
          header("Location: /products");
          exit;
        }
      }

      $router->render_view("products/create", [
        "errors" => $errors,
        "product" => $product_data,
        "id" => ''
      ]);
    }

    public static function update(Router $router){
      $id = $_GET["id"] ?? null;
      if(!$id) header("Location: /products");

      $errors = [];
      $product_data = $router->db->get_product_by_id($id);
      $product_data['image_path'] = $product_data['image'];
  
      if($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_data["title"] = $_POST["title"];
        $product_data["description"] = $_POST["description"];
        $product_data["price"] = (int)$_POST["price"];
        $product_data["image_file"] = $_FILES["image"] ?? null;

        $product = new Product();
        $product->load($product_data);
        $errors = $product->save();
        if(empty($errors)){
          header("Location: /products/update?id=$id");
          exit;
        }
      }

      $router->render_view("products/update", [
        "errors" => $errors,
        "product" => $product_data,
        "id" => $id
      ]);

    }

    public static function delete(Router $router){
      $id = $_POST["id"] ?? null;
      if($_SERVER["REQUEST_METHOD"] == "GET" || !$id) {
        header("Location: /products");
        exit;
      }

      $product = $router->db->get_product_by_id($id);
      
      if($product){
        $router->db->delete_product($id);
        $product = Product::delete_image($product['image']);
      }

      header("Location: /products");
    }
  }