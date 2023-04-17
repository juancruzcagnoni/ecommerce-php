<div class="container">
    <?php
    require __DIR__ . "/../data/shop.php";
    foreach ($products as $product) :
    ?>

        <h3><?= $product['product_title'] ?></h3>
        <a href="index.php?s=product-detail&id=<?= $product['product_id'];?>">Ver detalle</a>

    <?php
    endforeach;
    ?>
</div>