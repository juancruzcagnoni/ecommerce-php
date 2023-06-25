<?php
namespace App\Models;

use PDO;
use App\Database\DB;

class Vendedor
{
    private int $vendedor_id;
    private int $rol_fk;
    private ?string $nombre = null;
    private string $email;
    private string $password;

    public function byId(string $id): ?Vendedor
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM vendedores
                        WHERE vendedor_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Vendedor::class);
        $vendedor = $stmt->fetch();

        if (!$vendedor) {
            return null;
        }

        return $vendedor;
    }

    public function byEmail(string $email): ?Vendedor
    {
        $db = (new DB)->getConexion();
        $query = "SELECT * FROM vendedores
                        WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Vendedor::class);
        $vendedor = $stmt->fetch();

        if (!$vendedor) {
            return null;
        }

        return $vendedor;
    }

    public function create(array $data): void
    {
        $db = DB::getConexion();
        $query = "INSERT INTO vendedores (rol_fk, nombre, email, password)
                VALUES (:rol_fk, :nombre, :email, :password);";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'rol_fk'    => $data['rol_fk'],
            'nombre'     => $data['nombre'],
            'email'     => $data['email'],
            'password'  => $data['password'],
        ]);
    }

    public function getVendedorId(): int
    {
        return $this->vendedor_id;
    }

    public function setVendedorId(int $vendedor_id): void
    {
        $this->vendedor_id = $vendedor_id;
    }

    public function getRolFk(): int
    {
        return $this->rol_fk;
    }

    public function setRolFk(int $rol_fk): void
    {
        $this->rol_fk = $rol_fk;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
