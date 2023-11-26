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
    <title>User Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <!-- Add other stylesheets or inline styles as needed -->
</head>
<body>
    <!-- Include the header -->
    <?php include_once '../templates/header.php'; ?>

    <div class="container">
        <h2>User Profile</h2>
        <p class="welcome-message">Welcome, <?php echo $user['FirstName'] . ' ' . $user['LastName']; ?>!</p>

        <div class="profile-info">
            <div class="profile-item">
                <span class="label">Email:</span> <?php echo $user['Email']; ?>
            </div>
            <div class="profile-item">
                <span class="label">Gender:</span> <?php echo $user['Gender']; ?>
            </div>
            <div class="profile-item">
                <span class="label">Date of Birth:</span> <?php echo $user['DateOfBirth']; ?>
            </div>
            <div class="profile-item">
                <span class="label">Contact Number:</span> <?php echo $user['ContactNumber']; ?>
            </div>
            <div class="profile-item">
                <span class="label">Address:</span> <?php echo $user['Address']; ?>
            </div>
            <!-- Add more user data fields as needed -->

            <div class="edit-button">
                <a href="edit_profile_patient.php">Edit Profile</a>
            </div>
        </div>
    </div>

    <!-- Include the footer -->
    <?php include_once '../templates/footer.php'; ?>

</body>
</html>
