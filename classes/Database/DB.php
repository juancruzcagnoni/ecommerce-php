<?php
namespace App\Database;

use PDO;
use Exception;

// Esta clase nos da la conexion a la base de datos. 
class DB
{
    // Definimos los datos de conexion como propiedades de la clase. 
    private static string $db_host = '127.0.0.1:3306';
    private static string $db_user = 'root';
    private static string $db_pass = '';
    private static string $db_name = 'dw3_cagnoni_castrogamero_ferrari';

    private static ?PDO $db = null;

    // Obtiene la conexion a la base de datos.
    public static function getConexion(): PDO 
    {
        if (self::$db === null) {
            try {
                $db_dsn = 'mysql:host=' . self::$db_host . ';dbname=' . self::$db_name . ';charset=utf8mb4';
                self::$db = new PDO($db_dsn, self::$db_user, self::$db_pass);
    
            } catch (Exception $e) {
                echo "Ocurió un error al conectar con la base de datos: " . $e->getMessage();
            }
        }

        return self::$db;
    }
}