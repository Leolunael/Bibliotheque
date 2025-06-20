<?php

namespace src\configs;

use PDO;
use PDOException;

class MySqlConnection
{
    private static string $host = "localhost";
    private static string $db_name = "php";
    private static string $username = "root";
    private static string $password = "";
    private static ?PDO $connection = null;

    private function __construct(){
        try {
            $db = new PDO(
                "mysql:host=". self::$host. ";dbname=". self::$db_name,
                self::$username,
                self::$password
            );

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            error_log("Erreur de connexion : " . $e->getMessage(), PHP_EOL);
            return;
        }
        self::$connection = $db;
        self::initTable();
    }

    public static function getConnection(): PDO
    {
        if(self::$connection === null){
            new MySqlConnection();
        }

        return self::$connection;
    }

    private static function initTable(): void{
        $request = "CREATE TABLE IF NOT EXISTS users (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR(50) NOT NULL, 
            email VARCHAR(50)
        )";

        self::$connection->exec($request);
    }

    private static function initTable(): void{
        $request = "CREATE TABLE IF NOT EXISTS books (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            title VARCHAR(50) NOT NULL, 
            author VARCHAR(50) NOT NULL,
            isbn VARCHAR(50) NOT NULL, 
            users_id INT NOT NULL,
            FOREIGN KEY (users_id) REFERENCES users(id)
        )";

        self::$connection->exec($request);
    }

    private static function initTable(): void{
        $request = "CREATE TABLE IF NOT EXISTS category (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR(50) NOT NULL 
        )";

}