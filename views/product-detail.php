<?php

require_once __DIR__ . "/../classes/Shop.php";
// Pedimos el id del producto que nos piden mostrar.
$id = $_GET['id'];
$product = (new Products) -> byId($id);

?>

<div class="container">
    <h3><?= $product -> product_title ?></h3>
    <p>Aca se va a ver el producto <?= $product -> product_title ?> mas en detalle...</p>
</div>