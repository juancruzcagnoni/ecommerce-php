<div class="container">
    <?php
    // Incluimos el archivo de la libreria de productos.
    require_once __DIR__ . "/../classes/Shop.php";
    // Obtenemos los productos.
    $products = (new Products) -> all();
    ?>

    <div class="row">

        <?php foreach ($products as $product) : ?>

            <div class="col-md-3 col-6 p-3">
                <div class="card">
                    <div class="img-card-container">
                        <img width="100" class="img-fluid img-card" src="<?= $product -> img ?>">
                    </div>
                    <div class="product-detail">
                        <p class="product-title"><?= $product -> product_title ?></p>
                        <p><?= $product -> categorie?></p>
                        <div class="d-flex justify-content-between">
                            <a href="index.php?s=product-detail&id=<?= $product -> product_id; ?>">Ver detalle</a>
                            <p class="me-3">$<?= $product -> price ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>