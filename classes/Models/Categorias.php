<?php
namespace App\Models;

use App\Database\DB;
use PDO;

    class Categorias{
        private int $categoria_id;
        private string $nombre;

        /**
         * @return array|self[]
         */

        public function all(): array
        {
            $db = (new DB)->getConexion();
            $query = "SELECT * FROM categorias";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Categorias::class);

            return $stmt->fetchAll();
        }

        public function getCategoriaId(): int{
            return $this->categoria_id;
        }
        
        public function setCategoriaId(int $categoria_id): void{
            $this->categoria_id = $categoria_id;
        }

        public function getNombre(): string{
            return $this->nombre;
        }
        
        public function setNombre(string $nombre): void{
            $this->nombre = $nombre;
        }
    }
