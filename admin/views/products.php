<?php
    $products = (new Shop)->all();
?>

<section class="admin">
    <div class="container">
        <h1 class="title">Tablero de administración</h1>

        <div class="mb-4 publish-btn">
            <a href="index.php?s=publish-product">Publicar producto</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                    <td><?= $product->getProductId(); ?></td>
                    <td><?= $product->getName();?></td>
                    <td><?= $product->getDescription();?></td>
                    <td>$<?= $product->getPrice();?></td>
                    <td><?= $product->getStock();?></td>
                    <td class="td-img"><img class="img-fluid" src="<?= '../' . $product->getImage();?>" alt="<?= $product->getImagenDescripcion();?>"></td>
                    <td>
                        <a class="delete" href="index.php?s=delete-product&id=<?=$product->getProductId();?>">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>