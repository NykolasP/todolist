<?php
require_once 'connection.php';

function testDatabaseConnection() {
    $conn = Database::getConnection();

    if ($conn) {
        echo "Connected successfully to database!";
    } else {
        echo "Failed to connect to database.";
    }
}

testDatabaseConnection();
?>

<!DOCTYPE html>
<html>
<head>
        <title>ToDo List</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
        <div class="heading">
                <h2 style="font-style: 'Hervetica';">ToDo List</h2>
        </div>
        <form method="post" action="index.php" class="input_form">
                <input type="text" name="task" class="task_input">
                <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
        </form>
</body>
</html>
