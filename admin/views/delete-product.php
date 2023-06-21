<?php
$producto = (new Shop)->byId($_GET['id']);
?>
<section class="container">
    <h1 class="title mt-3">Confirmación para eliminar</h1>
    <p>Estas por eliminar el siguiente producto. Es necesario que confirmes la acción.</p>

    <article class="row">
        <div class="col-12 col-md-7">
            <div class="view-img-container">
                <img class="img-fluid" src="../<?= $producto->getImage() ?>" alt="Esta es una imagen descriptiva del producto">
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="product-details-view">
                <h1 class="title-detail"><?= $producto->getName() ?></h1>
                <p><?= $producto->getDescription() ?></p>
                <div class="d-flex justify-content-between mt-5">
                    <p class="price-detail">$<?= $producto->getPrice() ?></p>
                </div>
            </div>
        </div>
</article>

    <form action="actions/delete-product.php?id=<?= $producto->getProductId(); ?>" method="post">
        <button type="submit" class="delete-confirm">Eliminar</button>
    </form>
</section>