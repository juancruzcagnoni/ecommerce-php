<section class="publish">
    <div class="container">
        <h1 class="title">Publicar producto</h1>

        <form action="" method="post">
            <div>
                <label for="nombre">Nombre de el producto</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
            </div>
            <div>
                <label for="descripcion">Descripcion</label>
                <textarea type="text" id="descripcion" name="descripcion" class="form-control"></textarea>
            </div>
            <div>
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" class="form-control">
            </div>
            <div>
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control">
            </div>
            <div>
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="form-control">
            </div>
            <div>
                <label for="imagen_descripcion">Descripcion de la imagen</label>
                <textarea type="text" id="imagen_descripcion" name="imagen_descripcion" class="form-control"></textarea>
            </div>

            <button type="submit">Publicar</button>
        </form>
    </div>
</section>