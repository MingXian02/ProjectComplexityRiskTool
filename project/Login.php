<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEN NAN HUI 213054</title>
</head>

<body>

    <?php
    include 'PDO.php';
    ?>
    <h1>Please Log In</h1>
    <?php
    $salt = '1@3$5^7*9)';


    if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['position'])) {
        $check = hash('md5', $salt . $_POST['password']);
        $stmt = $pdo->prepare("select * from login where username = :username;");
        $stmt->execute(
            array(
                ':username' => $_POST['username'],
            )
        );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $name = $row['name'];
            $position = $row['position'];
            $username = $row['username'];
            $password = $row['password'];
        }
        if ($name == $_POST['name'] && $position == $_POST['position'] && $username == $_POST['username'] && $check == $password) {
            header("Location: ProjectList.php");
            return;
        } else {
            echo "Failed";
        }
    }
    ?>

    <form method="POST">
        <label for="name"><strong>Name: </strong></label>
        <input type="text" name="name" id="name"><br />
        <label for="position"><strong>Position: </strong></label>
        <input type="text" name="position" id="position"><br />
        <label for="username"><strong>Username: </strong></label>
        <input type="text" name="username" id="username"><br />
        <label for="password"><strong>Password: </strong></label>
        <input type="password" name="password" id="password"><br />
        <input type="submit" value="Log In">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <p><a href="index.php">Back to home page</a></p>

    <p>For a password hint, view source and find a password hint in the HTML comments</p>

</body>

</html>