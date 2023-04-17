<?php
    require __DIR__ . "/../data/shop.php";

    $id = $_GET['id'];

    foreach($products as $thisProduct){
        if ($thisProduct['product_id'] == $id) {
            $product = $thisProduct;
            break;
        }
    }
?>

<div class="container">
    <h1><?= $product['product_title'] ?></h1>
    <p>Aca se va a ver el producto mas en detalle</p>
</div>