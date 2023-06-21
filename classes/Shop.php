<?php

class Shop 
{
    // Definimos las propiedades.
    private int $producto_id;
    private string $nombre;
    private string $descripcion;
    private string $precio;
    private string $stock;
    private ?string $imagen;
    private ?string $imagen_desc;

    /**
     * Obtiene todos los productos.
     * 
     * @return Shop[]
     */
    public function all(): array 
    {
        // Traemos los productos de la base de datos.
        $db = (new DB)->getConexion();

        $query = "SELECT * FROM productos";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, Shop::class);
        // Retornamos todos los registros como un array usando fetchAll().
        return $stmt->fetchAll();
    }

    /**
     * Obtiene el producto por su id.
     * 
     * @param int $id
     * @return Shop|null
     */
    public function byId(int $id): ?Shop 
    {
        $db = (new DB)->getConexion();

        // Uso de holders.
        $query = "SELECT * FROM productos
                WHERE producto_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Shop::class);
        $producto = $stmt->fetch();

        if(!$producto) return null;

        return $producto;
    }

    public function create(array $data) 
    {
        $db = (new DB)->getConexion();
        $query = "INSERT INTO productos (vendedor_fk, nombre, descripcion, precio, stock, imagen, imagen_desc)
                    VALUES (:vendedor_fk, :nombre, :descripcion, :precio, :stock, :imagen, :imagen_desc)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'vendedor_fk'  => $data['vendedor_fk'],
            'nombre'       => $data['nombre'],
            'descripcion'  => $data['descripcion'],
            'precio'       => $data['precio'],
            'stock'        => $data['stock'],
            'imagen'       => $data['imagen'],
            'imagen_desc'  => $data['imagen_desc'],
        ]);
    }

    public function eliminar(int $id)
    {
        $db = (new DB)->getConexion();
        $query = "DELETE FROM productos
                    WHERE producto_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

    public function getProductId(): int
    {
        return $this->producto_id;
    }

    public function setProductoId(int $producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function getName(): string
    {
        return $this->nombre;
    }

    public function setName(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescription(): string
    {
        return $this->descripcion;
    }

    public function setDescription(string $descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getPrice(): int
    {
        return $this->precio;
    }

    public function setPrice(int $precio)
    {
        $this->precio = $precio;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }

    public function getImage(): ?string
    {
        return $this->imagen;
    }

    public function setImage(?string $imagen)
    {
        $this->imagen = $imagen;
    }

    public function getImagenDescripcion(): ?string
    {
        return $this->imagen_desc;
    }

    public function setImagenDescripcion(?string $imagen_desc)
    {
        $this->imagen_desc = $imagen_desc;
    }
}