<?php
namespace App\Database;

use PDO;
use Exception;

// Esta clase nos da la conexion a la base de datos. 
class DB
{
    // Definimos los datos de conexion como propiedades de la clase. 
    private string $db_host = '127.0.0.1:3306';
    private string $db_user = 'root';
    private string $db_pass = '';
    private string $db_name = 'dw3_cagnoni_castrogamero_ferrari';

    // Obtiene la conexion a la base de datos.
    public function getConexion(): PDO 
    {
        try {
            $db_dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8mb4';
            $db = new PDO($db_dsn, $this->db_user, $this->db_pass);

            return $db;
        } catch (Exception $e) {
            echo "Ocurió un error al conectar con la base de datos: " . $e->getMessage();
        }
    }
}