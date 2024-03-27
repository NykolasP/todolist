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
