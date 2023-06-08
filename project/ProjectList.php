<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEN NAN HUI 213054</title>
</head>

<body>
    <h1>Project List</h1>
    <?php
    require "PDO.php";

    if (!isset($_GET['username'])) {
        echo "<h1>You have not logged in</h1><br/>";
        echo "<a href='login.php'>Please Login</a><br/><br/>";
        die("Name parameter missing");
    }

    $list = $pdo->prepare("SELECT * FROM project WHERE username = :username");
    $list->bindValue(':username', $_GET['username']);
    $list->execute();
    $lists = $list->fetchAll(PDO::FETCH_ASSOC);
    foreach ($lists as $list) {
        echo "<h1>" . $list['name'] . "</h1>";
    }
    $url = $_GET['username'];
    ?>

    <a href="RegisterProject.php?username=<?php echo $url?>">Register Project</a>
</body>

</html>