<?php
class Authentication
{
    public function authenticate(string $email, string $password): bool{
        // Buscamos el usuario.
        $db = (new DB)->getConexion(); 
        $query = "SELECT * FROM vendedores
                    WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Vendedor::class);
        $vendedor = $stmt->fetch();

        // Preguntamos si el vendedor existe.
        if (!$vendedor) {
            return false;
        }

        // Comparamos la contraseña.
        if(!password_verify($password, $vendedor->getPassword())){
            return false;
        }

        // Autenticamos.
        $this->markAsAuthenticated($vendedor);
        return true;
    }
    
    public function logOut(){

    }
    
    public function isAuthenticated(){

    }

    public function markAsAuthenticated(Vendedor $vendedor): void{
        $_SESSION['vendedor_id'] = $vendedor->getVendedorId();
    }
}