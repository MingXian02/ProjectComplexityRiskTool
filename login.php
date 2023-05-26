<?php
// Include the pdo.php file to establish a database connection
require_once 'pdo.php';

// Start the session
session_start();

// Check if the user is already logged in, redirect to the desired page
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the submitted username and password (you can add more validation if needed)
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['Password']) {
        // Set the user session variable and redirect to the dashboard or desired page
        $_SESSION['user_id'] = $user['UserID'];
        header("Location: dashboard.php");
        exit;
    } else {
        // Increment the login attempts counter in session
        if (isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts']++;
        } else {
            $_SESSION['login_attempts'] = 1;
        }
        
        // Check if maximum login attempts reached
        if ($_SESSION['login_attempts'] >= 3) {
            // Block the user (you can add your own logic here, such as updating a 'blocked' flag in the database)
            // Display an error message
            $error = "Maximum login attempts exceeded. Please try again later.";
        } else {
            // Display an error message for invalid login credentials
            $error = "Invalid username or password.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h1>Login</h1>

            <?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>