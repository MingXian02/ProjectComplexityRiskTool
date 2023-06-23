<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/ProjectList.css">
    <title>THEN NAN HUI 213054</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-between"
        style="margin-bottom: 15px; padding: 0">
        <a class="navbar-brand" style="padding: 10px">
            <div style="font-size: 30px">Project List</div>
        </a>
        <ul class="navbar-nav">
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'RegisterProject.php?username=<?php echo $_GET['username'] ?>';">Register
                    New Project</button>
            </li>
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'Information.php?username=<?php echo $_GET['username'] ?>';">Information
                    Page</button>
            </li>
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'Home.php';">Logout</button>
            </li>
        </ul>
    </nav>

    <?php
    require "PDO.php";

    if (!isset($_GET['username'])) {
        echo "<h1>You have not logged in</h1><br/>";
        echo "<a href='login.php'>Please Login</a><br/><br/>";
        die("Name parameter missing");
    }

    echo "<h1>Welcome " . $_GET['username'] . "</h1>";

    $list = $pdo->prepare("SELECT * FROM project WHERE username = :username");
    $list->bindValue(':username', $_GET['username']);
    $list->execute();
    $lists = $list->fetchAll(PDO::FETCH_ASSOC);
    $url = $_GET['username'];

    if (empty($lists)) {
        echo "<div>";
        echo "<h3>No project</h3>";
        echo "</div>";
    }


    foreach ($lists as $list) {

        $projectScore = $pdo->prepare("SELECT * FROM projectscore WHERE name = :name");
        $projectScore->bindValue(':name', $list['name']);
        $projectScore->execute();
        $totalScore = $projectScore->fetchAll(PDO::FETCH_ASSOC);
        $name = $list['name'];
        echo "<ul>";
        echo '<li><div style="display: flex;"><h3 style="margin-right: 30px">' . $name . '</h3><a href="Assessment.php?project=' . $name . '/' . $url . '" class="btn btn-light">Do assessment</a></div></li></ul>';
        foreach ($totalScore as $total) {
            echo '<table style="background-color: green; width: 100%;">';
            echo '<tr>';
            echo '<td>Section 1</td>';
            echo '<td>' . $total['section1'] . '</td>';
            echo '</tr>';
            echo '<td>Section 2</td>';
            echo '<td>' . $total['section2'] . '</td>';
            echo '</tr>';
            echo '<td>Section 3</td>';
            echo '<td>' . $total['section3'] . '</td>';
            echo '</tr>';
            echo '<td>Section 4</td>';
            echo '<td>' . $total['section4'] . '</td>';
            echo '</tr>';
            echo '<td>Section 5</td>';
            echo '<td>' . $total['section5'] . '</td>';
            echo '</tr>';
            echo '<td>Section 6</td>';
            echo '<td>' . $total['section6'] . '</td>';
            echo '</tr>';
            echo '<td>Section 7</td>';
            echo '<td>' . $total['section7'] . '</td>';
            echo "</tr>";
            echo '</tr>';
            echo '<td>Total Score</td>';
            echo '<td>' . $total['total'] . '</td>';
            echo "</tr>";
            $levelQuery = $pdo->query("SELECT * FROM level");
            $levels = $levelQuery->fetchAll(PDO::FETCH_ASSOC);

            if ($total['total'] < 45) {
                $level = $levels[0];
            } elseif ($total['total'] >= 45 && $total['total'] <= 63) {
                $level = $levels[1];
            } elseif ($total['total'] >= 64 && $total['total'] <= 82) {
                $level = $levels[2];
            } else {
                $level = $levels[3];
            }

            echo '</tr>';
            echo '<td>Complexity and Risk Level</td>';
            echo '<td>' . $level['complexity'] . '</td>';
            echo '</tr>';
            echo '</tr>';
            echo '<td>Definition</td>';
            echo '<td>' . $level['definition'] . '</td>';
            echo '</tr>';
            echo "</table>";
        }
    }

    ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>