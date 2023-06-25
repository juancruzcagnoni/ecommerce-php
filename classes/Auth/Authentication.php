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
        unset($_SESSION['vendedor_id'], $_SESSION['rol_fk']);
    }
    
    public function isAuthenticated(): bool{
        return isset($_SESSION['vendedor_id']);
    }

    public function authenticatedAsAdmin(): bool{
        return $this->isAuthenticated() && $this->getVendedorRol() === 1;
    }

    public function markAsAuthenticated(Vendedor $vendedor): void{
        $_SESSION['vendedor_id'] = $vendedor->getVendedorId();
        $_SESSION['rol_fk'] = $vendedor->getRolFk();
    }

    public function getVendedorId(): ?int{
        if (!$this->isAuthenticated()) return null;
        return $_SESSION['vendedor_id'];
    }

    public function getVendedorRol(): ?int{
        if (!$this->isAuthenticated()) return null;

        return $_SESSION['rol_fk'];
    }

    public function getVendedor(): ?Vendedor{
        if (!$this->isAuthenticated()) return null;

        return (new Vendedor)->byId($_SESSION['vendedor_id']);
    }
}