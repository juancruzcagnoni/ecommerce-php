<div class="container">
    <?php
    // Incluimos el archivo de las classes de productos.

    use App\Models\Shop;

    require_once __DIR__ . "/../classes/Models/Shop.php";

    // Parametros de busqueda.
    $params = [
        ['stock', '>', 0]
    ];

    if (!empty($_GET['nombre'])) {
        $params[] = ['nombre', 'LIKE', '%' . $_GET['nombre'] . '%'];
    }

    // Obtenemos los productos.
    $products = (new Shop)->all($params);
    ?>

    <h1 class="title text-center mt-5">NUESTROS PRODUCTOS</h1>

    <div class="buscador-main">
        <form action="index.php" method="get">
            <input type="hidden" name="s" value="shop">
            <label for="nombre">Nombre</label>
            <div class="buscador">
                <input type="search" id="nombre" name="nombre" class="form-control" value="<?= $_GET['nombre'] ?? null; ?>">
                <button type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>

    <div class="row mb-5">

        <?php
        if (count($products) > 0) :

            if (!empty($_GET['nombre'])) :
        ?>
                <p>Estos son los resultados de tu búsqueda: <b><?= $_GET['nombre']; ?></b></p>
            <?php
            endif;

            foreach ($products as $product) :
            ?>

                <article class="col-md-3 col-12 p-3">
                    <div class="card">
                        <div class="img-card-container">
                            <img width="100" class="img-fluid img-card" src="<?= $product->getImage() ?>" alt="Esta es la imagen del producto: <?= $product->getName() ?>">
                        </div>
                        <div class="product-detail">
                            <h2 class="product-title mb-4"><?= $product->getName() ?></h2>
                            <div class="d-flex justify-content-between">
                                <a class="detail-view" href="index.php?s=product-detail&id=<?= $product->getProductId(); ?>">Ver detalle</a>
                                <p class="mb-0 price">$<?= $product->getPrice() ?></p>
                            </div>
                        </div>
                    </div>
                </article>

            <?php
            endforeach;
        else :
            ?>
            <p>No se encontraron resultados que coincidan con tu busqueda.</p>
        <?php
        endif;
        ?>

    </div>
</div>