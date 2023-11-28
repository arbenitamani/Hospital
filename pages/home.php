<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Get user data from the session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <!-- Add other stylesheets or inline styles as needed -->
</head>
<body>
    <!-- Include the header -->
    <?php include_once '../templates/header.php'; ?>

    <div class="container">
        <h2>Welcome, <?php echo $user['FirstName'] . ' ' . $user['LastName']; ?>!</h2>

        <p>This is your home page content. You can customize it based on your requirements.</p>
        
       <img src="../assets/images/doctors.jpg" width="300px"> 

    </div>

    <!-- Include the footer -->
    <?php include_once '../templates/footer.php'; ?>

</body>
</html>
