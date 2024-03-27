<?php
require_once 'db.php'; // Inclure la classe contenant les fonctions à tester

use PHPUnit\Framework\TestCase;

class TestClass extends TestCase
{
    // Test de l'insertion de tâches
    public function testInsertTask()
    {
        // Préparation des données de test
        $task = "Nouvelle tâche";

        // Appel de la fonction à tester
        $result = Database::insertTask($task);

        // Vérification du résultat
        $this->assertTrue($result); // La tâche devrait être insérée avec succès
    }

    // Test de la suppression de tâches
    public function testDeleteTask()
    {
        // Préparation des données de test
        $taskId = 1; // Supposons que l'ID 1 correspond à une tâche existante dans la base de données

        // Appel de la fonction à tester
        $result = Database::deleteTask($taskId);

        // Vérification du résultat
        $this->assertTrue($result); // La tâche devrait être supprimée avec succès
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
        $this->assertTrue($result); // La tâche devrait être mise à jour avec succès
    }
}