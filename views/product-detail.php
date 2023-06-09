<?php

use App\Models\Shop;

require_once __DIR__ . "/../classes/Models/Shop.php";
// Pedimos el id del producto que nos piden mostrar.
$id = $_GET['id'];
$product = (new Shop)->byId($id);

?>

<div class="container product-detail-section">
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="view-img-container">
                <img class="img-fluid" src="<?= $product->getImage() ?>" alt="Esta es una imagen descriptiva del producto">
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="product-details-view">
                <div>
                    <?php foreach($product->getCategorias() as $categoria): ?>
                        <span class="badge"><?= $categoria->getNombre(); ?></span>
                    <?php endforeach; ?>
                </div>
                <h1 class="title-detail"><?= $product->getName() ?></h1>
                <p><?= $product->getDescription() ?></p>
                <div class="d-flex justify-content-between mt-5">
                    <p class="price-detail">$<?= $product->getPrice() ?></p>
                    <button>Añadir al carro</button>
                </div>
            </div>
        </div>
    </div>
</div>