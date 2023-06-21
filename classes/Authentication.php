<?php
class Authentication
{
    public function authenticate(string $email, string $password): bool{
        // Buscamos el usuario.
        $vendedor = (new Vendedor)->byEmail($email);

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
    
    public function logOut(): void{
        unset($_SESSION['vendedor_id']);
    }
    
    public function isAuthenticated(): bool{
        return isset($_SESSION['vendedor_id']);
    }

    public function markAsAuthenticated(Vendedor $vendedor): void{
        $_SESSION['vendedor_id'] = $vendedor->getVendedorId();
    }
}