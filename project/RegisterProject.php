<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/RegisterProject.css">
    <title>Register your project</title>
</head>

<body>

    <?php
    include 'PDO.php';
    if (!isset($_GET['username'])) {
        echo "<h1>You have not logged in</h1><br/>";
        echo "<a href='login.php'>Please Login</a><br/><br/>";
        die("Name parameter missing");
    }
    ?>
    <h1>Project Registration</h1>

    <form method="POST">
        <label for="projectID">Project ID: </label>
        <?php
        $stmt = $pdo->prepare("select count(*) as total from project where username = :username;");
        $stmt->bindValue(':username', $_GET['username']);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            
            echo ($row['total'] + 1);

        }
        ?>
        <br />
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
    }

    if ($success !== false)
        echo ('<p style="color: green;">' . htmlentities($success) . "</p>\n");

    $url = $_GET['username'];
    ?>

    <a class="btn-project-list" href="ProjectList.php?username=<?php echo $url ?>">Project List</a>


</body>

</html>
