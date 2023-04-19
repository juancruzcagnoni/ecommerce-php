<div class="container">
    <?php
    // Incluimos el archivo de la libreria de productos.
    require_once __DIR__ . "/../libraries/shop.php";
    // Obtenemos los productos.
    $products = allProducts();
    ?>

    <div class="row">

        <?php foreach ($products as $product) : ?>

            <div class="col-md-3 col-6">
                <div class="img-card-container">
                    <img class="img-fluid img-card" src="<?= $product['img'] ?>">
                </div>
                <h3 id="plantName"><?= $product['product_title'] ?></h3>
                <div class="d-flex justify-content-between">
                    <a href="index.php?s=product-detail&id=<?= $product['product_id']; ?>">Ver detalle</a>
                    <p class="me-3">$<?= $product['price'] ?></p>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>