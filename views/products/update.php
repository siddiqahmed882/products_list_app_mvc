<header>
  <div class="container">
    <h3>Update Product</h3>
    <p>
      <a href="/products" class="btn btn-success">Go back to home page...</a>
    </p>
  </div>
</header>

<main>
  <div class="container">
    <?php if(!$product): ?>
      <p>No such product exists....</p>
    <?php else: ?>
      <?php include_once('_form.php') ?>
    <?php endif ?>
  </div>
</main>
