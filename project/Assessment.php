<?php
require_once "PDO.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Assessment</title>
    <!-- CSS styling -->
    <link rel="stylesheet" href="Assessment.css">
</head>

<body>
    <h1>Assessment</h1>

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