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
    $url = $_GET['username'];



    foreach ($lists as $list) {
        echo "<table>";
        $projectScore = $pdo->prepare("SELECT * FROM projectscore WHERE name = :name");
        $projectScore->bindValue(':name', $list['name']);
        $projectScore->execute();
        $totalScore = $projectScore->fetchAll(PDO::FETCH_ASSOC);
        $name = $list['name'];
        echo "<h3>" . $name . "</h3>";
        foreach ($totalScore as $total) {
            echo "<tr>";

            echo "<td>" . $total['total'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '<a href="Assessment.php?project=' . $name . '/' . $url . '">Do assessment</a>';

    }

    ?>
    <br>
    <a href="RegisterProject.php?username=<?php echo $url ?>">Register Project</a>
</body>

</html>