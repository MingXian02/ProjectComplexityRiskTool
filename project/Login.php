<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/Login.css"> 
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
        $stmt = $pdo->prepare("select * from user where username = :username;");
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
            if ($name == "admin" && $position == "admin" && $username == "admin") {
                header("Location: Maintenance.php?username=" . urlencode($_POST['username']));
            } else
                header("Location: ProjectList.php?username=" . urlencode($_POST['username']));
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

    <p><a href="Home.php">Back to home page</a></p>


</body>

</html>