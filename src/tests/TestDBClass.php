<?php
require_once 'db.php';

use PHPUnit\Framework\TestCase;

class TestDBClass extends TestCase
{   

    public function testGetConnection()
    {   
        // Appel de la fonction à tester    
        $result = Database::getConnection();

        // Vérification du résultat
        $this->assertNotNull($result); // Vérifie que la connexion n'est pas nulle
    }

    // Test de l'insertion de tâches
    public function testInsertTask()
    {
        // Préparation des données de test
        $task = "Nouvelle tâche";

        // Appel de la fonction à tester
        $result = Database::insertTask($task);

        // Vérification du résultat
        $this->assertTrue($result); // Vérifie que la tâche est insérée avec succès
    }

    // Test de la suppression de tâches
    public function testDeleteTask()
    {
        // Préparation des données de test
        $taskId = 1; // Supposons que l'ID 1 correspond à une tâche existante dans la base de données

        // Appel de la fonction à tester
        $result = Database::deleteTask($taskId);

        // Vérification du résultat
        $this->assertTrue($result); // Vérifie que la tâche est supprimée avec succès
    }

    // Test de la mise à jour de tâches
    public function testUpdateTask()
    {
        // Préparation des données de test
        $taskId = 1; // Supposons que l'ID 1 correspond à une tâche existante dans la base de données
        $editedTask = "Tâche mise à jour";

        // Appel de la fonction à tester
        $result = Database::updateTask($editedTask, $taskId);

        // Vérification du résultat
        $this->assertTrue($result); // Vérifie que la tâche est mise à jour avec succès
    }
}
