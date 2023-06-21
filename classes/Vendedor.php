<?php
    class Vendedor
    {
        private int $vendedor_id;
        private ?string $nombre = null;
        private string $email;
        private string $password;

        public function byEmail(string $email): ?Vendedor{
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

        public function getVendedorId(): int
        {
            return $this->vendedor_id;
        }

        public function setVendedorId(int $vendedor_id): void
        {
            $this->vendedor_id = $vendedor_id;
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
?>
