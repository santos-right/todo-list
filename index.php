<?php

    $errors = "";

    $db = mysqli_connect("localhost", "root", "santos", "todo_list");

    if(isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM items WHERE id=".$id);
        header('location: index.php');
    }
    
    if(isset($_POST['submit'])) {
        if(empty($_POST['task'])) {
            $errors = "You must fill in the task";
        }else{
            $task = $_POST['task'];
            $sql = "INSERT INTO items (text) VALUES ('$task')";
            mysqli_query($db, $sql);
            header('location: index.php');
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Todo List</title>
</head>
<body>
    <div class="heading"> <h1>Todo List</h1> </div>
    <form action="index.php" method="POST">
        <?php if(isset($errors)) { ?>
            <p> <?php echo $errors; ?> </p>
        <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" name="submit" id="add_btn" class="add_btn">Submit</button>
    </form>
    <table>
        <thead>
            <tr>
                <th> N </th>
                <th> Tasks </th>
                <th style="width: 60px">Action </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $items = mysqli_query($db, "SELECT * FROM items");

                $i = 1; while ($row = mysqli_fetch_array($items)) {
            ?>
            <tr>
                <td> <?php echo $i; ?> </td>
                <td class="task"> <?php echo $row['text']; ?> </td>
                <td class="delete"> <a href="index.php?del_task=<?php echo $row['id'] ?>"> X </a> </td>
            </tr>
            <?php $i++; }?>
        </tbody>
    </table>

</body>
</html>