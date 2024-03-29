<?php

require_once 'db.php';

use Codeception\Test\Unit;

class DatabaseTest extends Unit
{   
    protected function _before(){
        $_ENV['DB_HOST'] = 'localhost';
        $_ENV['DB_DATABASE'] = 'todolist';
        $_ENV['DB_PORT'] = '3306';
        $_ENV['DB_USER'] = 'user-todolist';
        $_ENV['DB_PASSWORD'] = 'pwd-todolist';
        $_ENV['DB_CHARSET'] = 'utf8mb4';
        $_ENV['DB_ENGINE'] = 'mysql';
    }

    public function testConnection()
    {   
        $conn = Database::getConnection();
        $this->assertInstanceOf(PDO::class, $conn);
    }

    public function testInsertTask()
    {
        $task = 'Test task';
        $this->assertTrue(Database::insertTask($task));
        $taskId = $this->getLastInsertedTaskId();
        Database::deleteTask($taskId);
    }

    public function testDeleteTask()
    {
        // Insérer une tâche pour pouvoir la supprimer
        $task = 'Test task';
        Database::insertTask($task);
        
        // Récupérer l'ID de la tâche insérée
        $taskId = $this->getLastInsertedTaskId();
        
        // Supprimer la tâche et vérifier si elle est supprimée
        $this->assertTrue(Database::deleteTask($taskId));
    }

    public function testUpdateTask()
    {
        // Insérer une tâche pour pouvoir la mettre à jour
        $task = 'Test task';
        Database::insertTask($task);
        
        // Récupérer l'ID de la tâche insérée
        $taskId = $this->getLastInsertedTaskId();
        
        // Mettre à jour la tâche et vérifier si elle est mise à jour correctement
        $editedTask = 'Edited test task';
        $this->assertTrue(Database::updateTask($editedTask, $taskId));

        // Récupérer l'ID de la tâche insérée
        $taskId = $this->getLastInsertedTaskId();
        // Supprimer la tâche et vérifier si elle est supprimée
        Database::deleteTask($taskId);
    }

    private function getLastInsertedTaskId()
    {
        $db = Database::getConnection();
        try {
            // Sélectionner l'ID de la dernière tâche insérée en utilisant MAX(id)
            $stmt = $db->query("SELECT MAX(id) as max_id FROM tasks");
            $lastTaskId = $stmt->fetch(PDO::FETCH_ASSOC);

            return $lastTaskId['max_id'];
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
            return false;
        }
    }
}
