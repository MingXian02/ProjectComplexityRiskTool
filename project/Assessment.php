<?php
require_once "PDO.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Assessment</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style/assessment.css">

<body>
    <?php
    session_start();
    if (!isset($_SESSION['option']))
        $_SESSION['option'] = array();
    if (!isset($_GET['project'])) {
        echo "<h1>You have not logged in</h1><br/>";
        echo "<a href='login.php'>Please Login</a><br/><br/>";
        die("Name parameter missing");
    }

    $project = explode('/', $_GET['project']);
    $name = $project[0];
    $username = $project[1];
    $sectionScores = array();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-between"
        style="margin-bottom: 15px; padding: 0">
        <a class="navbar-brand" style="padding: 10px">
            <div style="font-size: 30px">Assessment</div>
        </a>
        <ul class="navbar-nav">
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'ProjectList.php?username=<?php echo $username ?>';">Project
                    List</button>
            </li>
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'Information.php?username=<?php echo $username ?>';">Information
                    Page</button>
            </li>
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'Home.php';">Logout</button>
            </li>
        </ul>
    </nav>
    <?php
    if (!empty($sectionScore)) {

        // Display the section scores and overall score
        echo '<h2>Section Scores</h2>';
        for ($section = 0; $section < 7; $section++) {

            echo '<p>Section ' . ($section + 1) . ': ' . $sectionScores[$section] . '</p>';
        }

        echo '<h2>Overall Score</h2>';
        echo '<p>Total: ' . $totalScore . '</p>';
    }
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