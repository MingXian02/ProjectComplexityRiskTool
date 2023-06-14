<?php
require_once "PDO.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Assessment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/assessment.css">
</head>

<body>
    <h1>Assessment</h1>
    <?php
    if (!isset($_GET['project'])) {
        echo "<h1>You have not logged in</h1><br/>";
        echo "<a href='login.php'>Please Login</a><br/><br/>";
        die("Name parameter missing");
    }
    $project = explode('/', $_GET['project']);
    $name = $project[0];
    $username = $project[1];
    ?>


    <form method="POST">
        <!-- Add a container for the tab navigation -->
        <div>
            <ul>
                <?php
                require "Question.php";
                ?>
            </ul>
        </div>


        <button type="submit">Submit</button>
    </form>

    <?php
    require "Calculate.php";
    ?>
</body>

</html>
