<?php

  namespace app;
  use PDO;

  class Database{
    public PDO $pdo;

    public function __construct(){
      $this->pdo = new PDO("mysql:host=localhost;post3306;dbname=products_list_app", "siddiq", "test1234");
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

  }