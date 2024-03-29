<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class DatabaseCest
{
    public function addTask(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/index.php');
        $I->fillField('task', 'Nouvelle tâche');
        $I->click('submit');
        $I->seeInDatabase('tasks', ['task' => 'Nouvelle tâche']);
    }
}
