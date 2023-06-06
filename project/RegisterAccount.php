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
    <h1>Please Register</h1>
    <?php
    $salt = '1@3$5^7*9)';
    $success = false;

    if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['position']) && isset($_POST['confirm'])) {
        if ($_POST['password'] == $_POST['confirm']) {
            $password = hash('md5', $salt . $_POST['password']);
            $stmt = $pdo->prepare("insert into login (name, position, username, password) values (:name, :position, :username, :password)");
            $stmt->execute(
                array(
                    ':name' => $_POST['name'],
                    ':position' => $_POST['position'],
                    ':username' => $_POST['username'],
                    ':password' => $password,
                )
            );
            $success = "Account registered successfully!";
        }
    }
    if ($success !== false) {
        echo ('<p style="color: green;">' . htmlentities($success) . "</p>\n");
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
        <label for="password"><strong>Confirm Password: </strong></label>
        <input type="password" name="confirm" id="confirm"><br />
        <input type="submit" value="Register">
        <input type="reset" name="cancel" value="Cancel">
    </form>
    <p><a href="Login.php">Please login</a></p>
    <p><a href="index.php">Back to home page</a></p>



</body>

</html>