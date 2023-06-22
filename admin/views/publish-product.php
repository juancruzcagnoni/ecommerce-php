<?php
    // Consultamos si hay errores en la session.
    if (isset($_SESSION['errores'])) {
        $errores = $_SESSION['errores'];
        // Eliminamos la session para que los datos no se sigan mostrando.
        unset($_SESSION['errores']);
    } else {
        $errores = [];
    }
    // Consultamos si hay datos viejos.
    if (isset($_SESSION['oldData'])) {
        $oldData = $_SESSION['oldData'];
        unset($_SESSION['oldData']);
    } else {
        $oldData = [];
    }
?>

<section class="publish">
    <div class="container">
        <h1 class="title">Publicar producto</h1>

        <form action="actions/action-publish.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="nombre">Nombre de el producto <span class="small">(obligatorio)</span></label>
                <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                class="form-control"
                aria-describedby="help-nombre <?php if(isset($errores['nombre'])): ?> error-nombre <?php endif; ?>"
                value="<?= $oldData['nombre'] ?? null; ?>" 
                >
                    
                <div class="small" id="help-nombre">Debe tener al menos 2 caracteres.</div>
                <?php if(isset($errores['nombre'])): ?>
                <div class="error" id="error-nombre"><i class="bi bi-x"></i><?= $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <div>
                <label for="descripcion">Descripción <span class="small">(obligatorio)</span></label>
                <textarea
                    type="text"
                    id="descripcion"
                    name="descripcion"
                    class="form-control"
                    <?php if(isset($errores['descripcion'])): ?> aria-describedby="error-descripcion"> <?php endif; ?>
                ><?= $oldData['descripcion'] ?? null; ?></textarea>

                <?php if(isset($errores['descripcion'])): ?>
                    <div class="error" id="error-descripcion"><i class="bi bi-x"></i><?= $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <div>
                <label for="precio">Precio <span class="small">(obligatorio)</span></label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    class="form-control"
                    value="<?= $oldData['precio'] ?? null; ?>"
                    <?php if(isset($errores['precio'])): ?> aria-describedby="error-precio"> <?php endif; ?>

                <?php if(isset($errores['precio'])): ?>
                <div class="error" id="error-precio"><i class="bi bi-x"></i><?= $errores['precio']; ?></div>
                <?php endif; ?>
            </div>
            <div>
                <label for="stock">Stock</label>
                <input 
                    type="number" 
                    id="stock" 
                    name="stock" 
                    class="form-control"
                    value="<?= $oldData['stock'] ?? null; ?>">
            </div>
            <div>
                <label for="imagen">Imagen</label>
                <input 
                    type="file" 
                    id="imagen" 
                    name="imagen" 
                    class="form-control">
            </div>
            <div>
                <label for="imagen_desc">Descripcion de la imagen</label>
                <input 
                    type="text" 
                    id="imagen_desc" 
                    name="imagen_desc" 
                    class="form-control"
                    value="<?= $oldData['imagen_desc'] ?? null; ?>"
                >
            </div>

            <button type="submit">Publicar</button>
        </form>
    </div>
</section>