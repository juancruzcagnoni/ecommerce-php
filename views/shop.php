<div class="container">
    <?php
    // Incluimos el archivo de las classes de productos.
    require_once __DIR__ . "/../classes/Shop.php";
    // Obtenemos los productos.
    $products = (new Products) -> all();
    ?>

    <h2 class="title text-center mt-5">NUESTROS PRODUCTOS</h2>

    <div class="row mb-5">

        <?php foreach ($products as $product) : ?>

            <div class="col-md-3 col-6 p-3">
                <div class="card">
                    <div class="img-card-container">
                        <img width="100" class="img-fluid img-card" src="<?= $product -> img ?>" alt="Esta es la imagen del producto">
                    </div>
                    <div class="product-detail">
                        <p class="product-title"><?= $product -> product_title ?></p>
                        <p class="categorie"><?= $product -> categorie?></p>
                        <div class="d-flex justify-content-between">
                            <a class="detail-view" href="index.php?s=product-detail&id=<?= $product -> product_id; ?>">Ver detalle</a>
                            <p class="mb-0 price">$<?= $product -> price ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>