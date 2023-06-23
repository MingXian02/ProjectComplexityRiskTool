<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Register your project</title>
    <link rel="stylesheet" href="style/RegisterProject.css" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-between"
        style="margin-bottom: 15px; padding: 0">
        <a class="navbar-brand" style="padding: 10px">
            <div style="font-size: 30px">Project Registration</div>
        </a>
        <ul class="navbar-nav">
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg" style="margin-right: 10px"
                    onclick="location.href = 'ProjectList.php?username=<?php echo $_GET['username'] ?>';">Project
                    List</button>
            </li>
        </ul>
    </nav>

    <?php
    include 'PDO.php';
    if (!isset($_GET['username'])) {
        echo "<h1>You have not logged in</h1><br/>";
        echo "<a href='login.php'>Please Login</a><br/><br/>";
        die("Name parameter missing");
    }
    ?>

    <form method="POST">
        <div class="projectId">
            <p>Project ID:
                <?php
                $stmt = $pdo->prepare("select count(*) as total from project where username = :username;");
                $stmt->bindValue(':username', $_GET['username']);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {

                    echo ($row['total'] + 1);

                }
                ?>
            </p>
        </div>
        <label for="name">Project Name: </label>
        <input type="text" name="name"><br />
        <label for="owner">Owner: </label>
        <input type="text" name="owner"><br />
        <label for="funds">Financial/Funds: </label>
        <input type="text" name="funds"><br />
        <label for="duration">Project Duration: </label>
        <input type="text" name="duration"><br />
        <label for="mode">Mode: </label><br />
        <div class="radio-container">
            <input type="radio" name="mode" id="insource" value="insource" checked>
            <label for="insource">Insource</label>
            <input type="radio" name="mode" id="outsource" value="outsource">
            <label for="outsource">Outsource</label>
            <input type="radio" name="mode" id="cosource" value="cosource">
            <label for="cosource">Co-source</label>
            <input type="radio" name="mode" id="unspecified" value="unspecified">
            <label for="unspecified">Unspecified</label>
        </div>
        <input type="submit" value="Register">
    </form>

    <?php
    $success = false;

    if (isset($_POST['name']) && isset($_POST['owner']) && isset($_POST['funds']) && isset($_POST['duration']) && isset($_POST['mode']) && isset($_GET['username'])) {
        $check = $pdo->prepare("select count(*) from project where name = :name");
        $check->execute(
            array(
                'name' => $_POST['name'],
            )
        );
        $isRegistered = $check->fetchColumn();
        if ($isRegistered != 1) {
            $stmt = $pdo->prepare("insert into project (name, owner, funds, duration, mode, username) values (:name, :owner, :funds, :duration, :mode, :username)");
            $stmt->execute(
                array(
                    ':name' => $_POST['name'],
                    ':owner' => $_POST['owner'],
                    ':funds' => $_POST['funds'],
                    ':duration' => $_POST['duration'],
                    ':mode' => $_POST['mode'],
                    ':username' => $_GET['username']
                )
            );
            $success = "Register successful";
        } else {
            echo '<script type ="text/JavaScript">';
            echo 'alert("The project is registered!!")';
            echo '</script>';
        }
    }

    if ($success !== false) {
        echo "<div style='border-radius: 10px; background-color: white; margin: auto; padding: 5px; width: 350px; text-align: center; vertical-align: center'>";
        echo ('<p style="color: rgb(0, 255, 0); font-size: 20px; margin: 0">' . htmlentities($success) . "</p>\n");
        echo "</div>";
    }

    $url = $_GET['username'];
    ?>

</body>

</html>