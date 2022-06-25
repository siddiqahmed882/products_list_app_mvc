<?php

  namespace app\models;

use app\Database;

  class Product{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?int $price = null;
    public ?string $image_path = null;
    public ?array $image_file = null;

    public function __construct() {
      // code...
    }

    public function load($data){
      $this->id = $data['id'] ?? null;
      $this->title = $data['title'];
      $this->description = $data['description'] ?? null;
      $this->price = $data['price'];
      $this->image_path = $data['image_path'] ?? null;
      $this->image_file = $data['image_file'] ?? null;
    }

    public function save(){
      $errors = [];
      if(!$this->title) $errors[] = "product title is required";
      if(!$this->price) $errors[] = "product price is required";

      if(!is_dir(__DIR__ . '/../public/uploads')) mkdir('uploads');
      if(!is_dir(__DIR__ . '/../public/uploads/products')) mkdir('uploads/products');

      if(empty($errors)){
        $db = Database::$db;
        if(!$this->id){
          $db->create_product($this);
          // get last insert id if image is also uploaded
          if(!empty($this->image_file['full_path'])){
            $image_tmp_name = $this->image_file['tmp_name'];
            $image_ext = pathinfo($this->image_file['name'], PATHINFO_EXTENSION);
            $product_id = $db->get_last_product_id();
            $this->image_path = "uploads/products/product_$product_id.$image_ext";
            move_uploaded_file($image_tmp_name, $this->image_path);
            $db->insert_image($product_id, $this->image_path);
          }
        } else{
          if(!empty($this->image_file['full_path'])){
            if($this->image_path) Product::delete_image($this->image_path);
            $image_tmp_name = $this->image_file['tmp_name'];
            $image_ext = pathinfo($this->image_file['name'], PATHINFO_EXTENSION);
            $this->image_path = "uploads/products/product_$this->id.$image_ext";
            move_uploaded_file($image_tmp_name, $this->image_path);
          }
          $db->update_product($this);
        }
      }
      return $errors;
    }

    public static function delete_image($image_path){
      unlink($image_path);
    }

  }