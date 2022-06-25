<?php

  namespace app;

use app\models\Product;
use PDO;

  class Database{
    public PDO $pdo;
    public static Database $db;

    public function __construct(){
      $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=products_list_app", "siddiq", "test1234");
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$db = $this;
    }

    public function get_products($search_string = ""){
      $statement = $this->pdo->prepare("SELECT * FROM products ORDER BY created_at DESC");

      if($search_string){
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE title LIKE :search");
        $statement->bindValue(":search", "%$search_string%"); 
      }
      $statement->execute();
      $products = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $products;
    }

    public function create_product(Product $product) {
      $statement = $this->pdo->prepare(
        "INSERT INTO products (title, price, description, image) VALUES(:title, :price, :description, :image)"
      );
      $statement->bindValue(':title', $product->title);
      $statement->bindValue(':price', $product->price);
      $statement->bindValue(':description', $product->description);
      $statement->bindValue(':image', $product->image_path);
      $statement->execute();
    }

    public function get_last_product_id(){
      return $this->pdo->lastInsertId();
    }

    public function insert_image($id, $image_path) {
      $statement = $this->pdo->prepare("UPDATE products SET image = :image WHERE id = :id");
      $statement->bindValue(":image", $image_path);
      $statement->bindValue(":id", $id);
      $statement->execute();
    }

    public function get_product_by_id($id) {
      $statement = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
      $statement->bindValue(":id", $id);
      $statement->execute();
      $product = $statement->fetchAll(PDO::FETCH_ASSOC)[0] ?? null;
      return $product;
    }

    public function update_product(Product $product) {
      $statement = $this->pdo->prepare("UPDATE products SET title = :title, price = :price, description = :description, image = :image WHERE id = :id");
      $statement->bindValue(":title", $product->title);
      $statement->bindValue(":price", $product->price);
      $statement->bindValue(":description", $product->description);
      $statement->bindValue(":image", $product->image_path);
      $statement->bindValue(":id", $product->id);
      $statement->execute();
    }

    public function delete_product($id) {
      $statement = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
      $statement->bindValue(":id", $id);
      $statement->execute();
    }
  }