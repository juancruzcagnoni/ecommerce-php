<?php

namespace App\Models;

use PDO;
use App\Database\DB;

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
     * @var array|Categoria[]
     */
    private array $categorias = [];

    /**
     * Obtiene todos los productos.
     * @param array $search
     * @return Shop[]
     */
    public function all(array $search = []): array
    {
        // Traemos los productos de la base de datos.
        $db = DB::getConexion();

        $query = "SELECT * FROM productos";

        $conditions = [];
        $conditionValues = [];
        if (count($search) > 0) {
            foreach ($search as $searchData) {
                $conditions[] = $searchData[0] . " " . $searchData[1] . " ?";

                $conditionValues[] = $searchData[2];
            }

            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $db->prepare($query);
        $stmt->execute($conditionValues);

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
        $db = DB::getConexion();

        // Uso de holders.
        $query = "SELECT * FROM productos
                WHERE producto_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Shop::class);
        $producto = $stmt->fetch();

        if (!$producto) return null;

        // Traemos las de las categorias.
        $producto->cargarCategorias();

        return $producto;
    }

    public function cargarCategorias()
    {
        $db = DB::getConexion();
        $query = "SELECT 
                    e.* 
                    FROM productos_tienen_categorias nte
                    INNER JOIN categorias e
                    ON e.categoria_id = nte.categoria_fk
                    WHERE producto_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->getProductId()]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Categoria::class);

        $this->setCategorias($stmt->fetchAll());
    }

    public function create(array $data)
    {
        $db = DB::getConexion();
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

        // Categorias
        $productoId = $db->lastInsertId();

        $this->vincularCategorias($productoId, $data['categorias_fk']);
    }

    public function vincularCategorias(int $productoId, array $categoriasIds): void
    {
        // Verificamos que haya categorias
        if (count($categoriasIds) > 0) {
            // Preparamos las variables.
            $valuesList = [];
            $holdersData = [];

            foreach ($categoriasIds as $categoriaId) {
                $valuesList[] = "(?, ?)";
                $holdersData[] = $productoId;
                $holdersData[] = $categoriaId;
            }

            // Armamos el query
            $db = DB::getConexion();
            $query = "INSERT INTO productos_tienen_categorias (producto_fk, categoria_fk)
                        VALUES " . implode(', ', $valuesList);
            $stmt = $db->prepare($query);
            $stmt->execute($holdersData);
        }
    }

    public function edit(int $id, array $data)
    {
        $db = DB::getConexion();
        $query = "UPDATE productos
                    SET nombre        = :nombre,
                        descripcion   = :descripcion,
                        precio        = :precio,
                        stock         = :stock,
                        imagen        = :imagen,
                        imagen_desc   = :imagen_desc
                    WHERE producto_id = :producto_id;";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'nombre'       => $data['nombre'],
            'descripcion'  => $data['descripcion'],
            'precio'       => $data['precio'],
            'stock'        => $data['stock'],
            'imagen'       => $data['imagen'],
            'imagen_desc'  => $data['imagen_desc'],
            'producto_id'  => $id,
        ]);

        $this->desvincularCategorias($id);
        $this->vincularCategorias($id, $data['categorias_fk']);
    }

    public function eliminar(int $id)
    {
        // Eliminamos las relaciones con las categorias.
        $this->desvincularCategorias($id);

        $db = DB::getConexion();
        $query = "DELETE FROM productos
                    WHERE producto_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

    public function desvincularCategorias(int $id): void
    {
        $db = DB::getConexion();
        $query = "DELETE FROM productos_tienen_categorias
                    WHERE producto_fk = ?";
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

    public function getCategoriasFks(): array
    {
        $fks = [];

        foreach($this->categorias as $categoria) {
            $fks[] = $categoria->getCategoriaId(); 
        }

        return $fks;
    }

    /**
     * @return Categoria[]
     */
    public function getCategorias(): array
    {
        return $this->categorias;
    }

    /**
     * @param array|Categoria[] $categorias
     */
    public function setCategorias(array $categorias)
    {
        $this->categorias = $categorias;
    }
}
