<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/Login.css">
    <title>Login page</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between" style="margin-bottom: 5px;">
        <a class="navbar-brand">Project Complexity and Risk</a>
        <ul class="navbar-nav">
            <li class="navbar-link">
                <button class="btn" onclick="location.href = 'Register.php';">Register</button>
            </li>
            <li class="navbar-link">
                <button class="btn" onclick="location.href = 'Home.php';">Back To Home</button>
            </li>
        </ul>
    </nav>

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
            if ($name == "admin" && $position == "Admin" && $username == "admin") {
                header("Location: Maintenance.php?username=" . urlencode($_POST['username']));
            } else
                header("Location: ProjectList.php?username=" . urlencode($_POST['username']));
            return;
        } else {
            echo "<div style='border-radius: 10px; background-color: white; margin: 10px; padding: 5px; width: 350px; text-align: center; vertical-align: center'>";
            echo '<p style="color: red; font-size: 20px; margin: 0">Incorrect username or password</p>';
            echo "</div>";
        }
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
            <option value="Admin">Admin</option>
        </select>
        <label for="username"><strong>Username: </strong></label>
        <input type="text" name="username" id="username"><br />
        <label for="password"><strong>Password: </strong></label>
        <input type="password" name="password" id="password"><br />
        <input type="submit" value="Log In">
        <input type="reset" name="cancel" value="Cancel">
    </form>

</body>

</html>