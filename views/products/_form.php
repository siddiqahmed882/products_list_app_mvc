<?php if(!empty($errors)): ?>
  <div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
      <div><?= $error ?></div>
    <?php endforeach ?>
  </div>
<?php endif ?>
<?php if($product['image']): ?>
  <img src="/<?= $product["image"] ?>" alt="<?= $product["title"] ?>" class="product-image" />
<?php endif ?>
<form action="<?= $_SERVER['PHP_SELF'] ?><?= $id ? '?id='.$id : '' ?>" enctype="multipart/form-data" method="POST">
  <div class="mb-3">
    <label for="image" class="form-label">Product Image</label>
    <input type="file" accept="image/*" name="image" class="form-control" id="image" />
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Product Title:</label>
    <input type="text" name="title" class="form-control" id="title" value="<?= $product["title"] ?>" />
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Product Price:</label>
    <input type="number" min="0" name="price" class="form-control" id="price" value="<?= $product["price"] ?>"/>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Product Description:</label>
    <textarea name="description" id="description" class="form-control"><?= $product["description"] ?></textarea>
  </div>
  <input type="submit" name="submit" value="submit">
</form>