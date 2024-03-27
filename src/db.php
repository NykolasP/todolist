<?php

class Database {
    private static $host;
    private static $db_name;
    private static $port;
    private static $user;
    private static $password;
    private static $charset;
    private static $engine;

    public static function getConnection() {
        static $conn;
        $env = parse_ini_file('.env');
        
        if ($conn === null) {
            self::$host = $env['DB_HOST'] ?: 'mysql';
            self::$db_name = $env['DB_DATABASE'] ?: 'todolist';
            self::$port = $env['DB_PORT'] ?: '3306';
            self::$user = $env['DB_USER'] ?: 'user_todolist';
            self::$password = $env['DB_PASSWORD'] ?: 'pw_todolist';
            self::$charset = $env['DB_CHARSET'] ?: 'utf8mb4';
            self::$engine = $env['DB_ENGINE'] ?: 'mysql';

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

    public static function insertTask($task) {
        $db = self::getConnection();
        try {
            $stmt = $db->prepare("INSERT INTO tasks (task) VALUES (:task)");
            $stmt->bindParam(':task', $task, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            return false;
        }
    }

    public static function deleteTask($id) {
      $db = self::getConnection();
      try {
          $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
          $stmt->bindParam(':id', $id);
          $stmt->execute();
          return true;
      } catch (PDOException $exception) {
          echo "Error: " . $exception->getMessage();
          return false;
      }
  }

    public static function updateTask($edited_task, $task_id) {
        $db = self::getConnection();
        try {
            $stmt = $db->prepare("UPDATE tasks SET task = :task WHERE id = :id");
            $stmt->bindParam(':task', $edited_task, PDO::PARAM_STR);
            $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            return false;
        }
    }
}
