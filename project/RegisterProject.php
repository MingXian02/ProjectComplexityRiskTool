<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register your project</title>
</head>

<body>

    <?php
    include 'PDO.php';
    ?>
    <h1>Project Registration</h1>

    <form method="POST">
        <label for="projectID">Project ID: </label>
        <?php
        $stmt = $pdo->query("select count(*) as total from project;");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){
        echo ($row['total']);

        }
        ?>
        <br/>
        <label for="name">Project Name: </label>
        <input type="text" name="name"><br />
        <label for="owner">Owner: </label>
        <input type="text" name="owner"><br />
        <label for="funds">Financial/Funds: </label>
        <input type="text" name="funds"><br />
        <label for="duration">Project Duration: </label>
        <input type="text" name="duration"><br />
        <label for="mode">Mode: </label><br />
        <input type="radio" name="mode" value="insource">Insource
        <input type="radio" name="mode" value="outsource">Outsource
        <input type="radio" name="mode" value="cosource">Co-source
        <input type="radio" name="mode" value="unspecified">Unspecified<br/>
        <input type="submit" value="Register">
    </form>

    <?php
    $success = false;

    if (isset($_POST['name']) && isset($_POST['owner']) && isset($_POST['funds']) && isset($_POST['duration']) && isset($_POST['mode'])) {
        $stmt = $pdo->prepare("insert into project (name, owner, funds, duration, mode) values (:name, :owner, :funds, :duration, :mode)");
        $stmt->execute(
            array(
                ':name' => $_POST['name'],
                ':owner' => $_POST['owner'],
                ':funds' => $_POST['funds'],
                ':duration' => $_POST['duration'],
                ':mode' => $_POST['mode'],
            )
        );
        $success = "Register successful";
    }

    if ($success !== false)
        echo ('<p style="color: green;">' . htmlentities($success) . "</p>\n");
    ?> 

</body>

</html>