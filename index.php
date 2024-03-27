<?php
require_once 'connection.php';

$errors = "";
$db = Database::getConnection();

if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    } else {
        $task = $_POST['task'];
        try {
            $stmt = $db->prepare("INSERT INTO tasks (task) VALUES (:task)");
            $stmt->bindParam(':task', $task);
            $stmt->execute();
            header('Location: index.php');
            exit();
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}

if (isset($_GET['del_task'])) {
  $id = $_GET['del_task'];

  try {
      $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      header('Location: index.php');
      exit();
  } catch (PDOException $exception) {
      echo "Error: " . $exception->getMessage();
  }
}

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
                <button type="submit" name="submit" id="add_btn" class="add_btn">Ajouter une tache</button>
        </form>
        <table>
        <thead>
                <tr>
                        <th>N</th>
                        <th>Taches</th>
                        <th style="width: 60px;">Action</th>
                </tr>
        </thead>

        <tbody>
                <?php
                try {
                    $stmt = $db->query("SELECT * FROM tasks");
                    $i = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="task"><?php echo htmlspecialchars($row['task']); ?></td>
                            <td class="delete">
                                <a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
                            </td>
                        </tr>
                        <?php $i++;
                    }
                } catch (PDOException $exception) {
                    echo "Error: " . $exception->getMessage();
                }
                ?>
        </tbody>
        </table>
        <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
        <?php } ?>
</body>
</html>
