<!DOCTYPE html>
<html>

<head>
    <title>Maintenance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/change.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-between"
        style="margin-bottom: 15px; padding: 0">
        <a class="navbar-brand" style="padding: 10px">
            <div style="font-size: 30px">Change level</div>
        </a>
        <ul class="navbar-nav">

            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'Maintenance.php';">Back to Maintenance</button>
            </li>
        </ul>
    </nav>

    <?php
    require "PDO.php";
    $id = $_GET['id'];
    $levelQuery = $pdo->prepare("SELECT * FROM level where id = :id");
    $levelQuery->bindValue(":id", $id);
    $levelQuery->execute();
    $levels = $levelQuery->fetchAll(PDO::FETCH_ASSOC);

    echo "<div>";
    echo "<table>";
    foreach ($levels as $level) {
        echo '<tr>';
        echo '<td>' . $level['complexity'] . '</td>';
        echo '<form method="POST">';
        echo '<td><label>Change Complexity Level:</label>';
        echo '<input type="text" name="level' . $id . '">';
        echo '<input type="submit" value="Change Complexity Level"></form><br/>';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $level['definition'] . '</td>';
        echo '<form method="POST">';
        echo '<td><label>Change Definition:</label><br>';
        echo '<textarea row="10" cols="40" name="def' . $id . '"></textarea><br>';
        echo '<input type="submit" value="Change Definition"></form><br/>';
        echo '</td>';
        echo '</tr>';
        
        echo '</table>';
        echo '</div>';

    }

    if (isset($_POST['level' . $id])) {
        $update = $pdo->prepare("update level set complexity = :complexity where id = :id");
        $update->execute(
            array(
                ":complexity" => $_POST['level' . $id],
                ":id" => $id,
            )
        );
    }

    if (isset($_POST['def' . $id])) {
        $update = $pdo->prepare("update level set definition = :def where id = :id");
        $update->execute(
            array(
                ":def" => $_POST['def' . $id],
                ":id" => $id,
            )
        );
    }
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>