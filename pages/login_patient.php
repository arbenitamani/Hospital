<?php
include_once '../includes/db_connection.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user from Patients table based on email (assuming email is unique)
    $query = "SELECT * FROM Patients WHERE Email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $user['Password'])) {
            // Authentication successful, create a session
            session_start();

            // Store user data in the session
            $_SESSION['user'] = $user;

            // Redirect the user to their profile page
            header("Location: profile.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid password.";
        }
    } else {
        // User not found
        echo "User not found.";
    }
}

mysqli_close($connection);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login_patient.css">
</head>
<body>
  

    <div class="container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <?php include_once '../templates/footer.php'; ?>
</body>
</html>
