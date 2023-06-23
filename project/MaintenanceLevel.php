<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/maintenance.css">
    <title>Maintenance</title>
    <style>
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-between"
        style="margin-bottom: 15px; padding: 0">
        <a class="navbar-brand" style="padding: 10px">
            <div style="font-size: 30px">Maintenance level</div>
        </a>
        <ul class="navbar-nav">
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'MaintenanceQuestionRating.php';">Change Question and Rating</button>
            </li>
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'Home.php?>';">Logout</button>
            </li>
        </ul>
    </nav>
    <?php
    require "PDO.php";
    $levelQuery = $pdo->query("SELECT * FROM level");
    $levels = $levelQuery->fetchAll(PDO::FETCH_ASSOC);
    $id = 1;
    foreach ($levels as $level) {
        echo '<table style="width: 100%; background-color: green">';
        echo '<tr>';
        echo '<td style="width: 20%">' . $level['complexity'] . '</td>';
        echo '<td style="width: 70%">' . $level['definition'] . '</td>';
        echo '<td style="width: 10%"><a href="ChangeLevel.php?id='. $id .'">Change</a></td>';
        echo '</tr>';
        echo '</table>';
        $id++;
    }
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>