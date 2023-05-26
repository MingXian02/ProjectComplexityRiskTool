<?php
// Start the session
session_start();


// Retrieve the user ID from the session
$userID = $_SESSION['user_id'];

// Retrieve the user details from the database based on the user ID
// Replace this with your own code to fetch user details from the database
// You can use the $userID variable to query the database and retrieve the relevant information

// Example: Retrieving the user details from a hypothetical users table
// $stmt = $pdo->prepare("SELECT * FROM users WHERE UserID = :userID");
// $stmt->execute([':userID' => $userID]);
// $user = $stmt->fetch(PDO::FETCH_ASSOC);
// $name = $user['Name'];
// $position = $user['Position'];

// For demonstration purposes, we'll use hardcoded values
$name = "Choi Ming Xian";
$position = "Project Manager";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <p>Name: <?php echo $name; ?></p>
        <p>Position: <?php echo $position; ?></p>
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
