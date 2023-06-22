<?php
namespace App\Auth;

use App\Models\Vendedor;

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

    public function getVendedorId(): ?int{
        if (!$this->isAuthenticated()) return null;
        return $_SESSION['vendedor_id'];
    }

    public function getVendedor(): ?Vendedor{
        if (!$this->isAuthenticated()) return null;

        return (new Vendedor)->byId($_SESSION['vendedor_id']);
    }
}