<?php
class Database {
    private static $host = 'localhost';
    private static $db_name = 'todolist';
    private static $port = '8889';
    private static $user = 'root';
    private static $password = 'root';
    private static $charset = 'utf8mb4';
    private static $engine = 'mysql';

    public static function getConnection() {
        static $conn;

        if ($conn === null) {
            try {
                $conn = new PDO(
                    self::$engine . ':host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$db_name . ';charset=' . self::$charset,
                    self::$user,
                    self::$password
                );
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
        }
        return $conn;
    }
}
