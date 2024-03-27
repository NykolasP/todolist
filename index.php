<?php
require_once 'db.php';

$errors = "";
$db = Database::getConnection();

if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    } else {
      $task = htmlspecialchars($_POST['task']);
        if(Database::insertTask($task)) {
            header('Location: index.php');
            exit();
        }
    }
}

if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    if(Database::deleteTask($id)) {
        header('Location: index.php');
        exit();
    }
}

if (isset($_POST['edit_task']) && isset($_POST['task_id'])) {
  $edited_task = htmlspecialchars($_POST['edit_task']);
  $task_id = $_POST['task_id'];
    if(Database::updateTask($edited_task, $task_id)) {
        header('Location: index.php');
        exit();
    }
}

$page_title = "Welcome !";
include_once 'html_assets/header.php';
?>
<form method="post" action="index.php" class="input_form">
    <input type="text" name="task" class="task_input">
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add a new task</button>
</form>
<table>

        <thead>
                <tr>
                        <th class="task">N</th>
                        <th>Tasks</th>
                        <th style="width: 120px;">Action</th>
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
                <td class="task">
                    <?php if (isset($_GET['edit_task']) && $_GET['edit_task'] == $row['id']) { ?>
                        <form method="post" action="index.php">
                            <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="edit_task" value="<?php echo htmlspecialchars($row['task']); ?>">
                            <button type="submit">Save</button>
                        </form>
                    <?php } else { ?>
                        <span><?php echo htmlspecialchars($row['task']); ?></span>
                    <?php } ?>
                </td>
                <td class="actions">
                    <?php if (isset($_GET['edit_task']) && $_GET['edit_task'] == $row['id']) { ?>
                        <span class="cancel">
                            <a href="index.php">Cancel</a>
                        </span>
                    <?php } else { ?>
                        <span class="edit">
                            <a href="index.php?edit_task=<?php echo $row['id']; ?>">Edit</a>
                        </span>
                        <span class="delete">
                            <a href="index.php?del_task=<?php echo $row['id']; ?>">Delete</a>
                        </span>
                    <?php } ?>
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
