<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/RegisterAccount.css">
    <title>Register your account</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-between" style="margin-bottom: 15px; padding: 0">
        <a class="navbar-brand" style="padding: 10px">
            <div style="font-size: 30px">Project Complexity and Risk</div>
        </a>
        <ul class="navbar-nav">
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg"  style="margin-right: 10px" onclick="location.href = 'Login.php';">Login</button>
            </li>
            <li class="navbar-link">
                <button class="btn btn-outline-danger btn-lg"  style="margin-right: 10px" onclick="location.href = 'Home.php';">Back to Home</button>
            </li>
        </ul>
    </nav>

    <?php
    include 'PDO.php';
    ?>
    <h1>Please Register</h1>
    <?php
    $salt = '1@3$5^7*9)';
    $failure = false;
    $success = false;

    if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['position']) && isset($_POST['confirm'])) {
        if (strlen($_POST['name']) < 4) {
            $failure = "Name must at least 4 characters";
        } else if (strlen($_POST['username']) < 4) {
            $failure = "Username must at least 4 characters";
        } else if (strlen($_POST['password']) < 6) {
            $failure = "Password must at least 6 characters";
        } else if ($_POST['password'] == $_POST['confirm']) {
            $password = hash('md5', $salt . $_POST['password']);
            $stmt = $pdo->prepare("insert into user (name, position, username, password) values (:name, :position, :username, :password)");
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
    if ($failure !== false) {
        echo "<div style='border-radius: 10px; background-color: white; margin: 10px; padding: 5px; width: 350px; text-align: center; vertical-align: center'>";
        echo ('<p style="color: red; font-size: 20px; margin: 0">' . htmlentities($failure) . "</p>\n");
        echo "</div>";
    }
    if ($success !== false) {
        echo "<div style='border-radius: 10px; background-color: white; margin: 10px; padding: 5px; width: 350px; text-align: center; vertical-align: center'>";
        echo ('<p style="color: rgb(0, 255, 0); font-size: 20px; margin: 0">' . htmlentities($success) . "</p>\n");
        echo "</div>";
    }
    ?>

    <form method="POST">
        <label for="name"><strong>Name: </strong></label>
        <input type="text" name="name" id="name"><br />
        <label for="position">Choose a position:</label>

        <select name="position" class="position"
            style="width: 25%; padding: 8px; background-color: rgba(255, 255, 255, 0.5);">
            <option value="none" selected disabled hidden>Please select a position</option>
            <option value="Manager">Manager</option>
            <option value="Student">Student</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Software Developer">Software Developer</option>
            <option value="Software Tester">Software Tester</option>
            <option value="Supervisor">Supervisor</option>
        </select>
        <label for="username"><strong>Username: </strong></label>
        <input type="text" name="username" id="username"><br />
        <label for="password"><strong>Password: </strong></label>
        <input type="password" name="password" id="password"><br />
        <label for="password"><strong>Confirm Password: </strong></label>
        <input type="password" name="confirm" id="confirm"><br />
        <input type="submit" value="Register">
        <input type="reset" name="cancel" value="Cancel">
    </form>


</body>

</html>