<?php
session_start();

include_once '../includes/db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Get user data from the session
$user = $_SESSION['user'];

// Initialize success message variable
$successMessage = '';

// Handle form submission for updating user data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve edited data from the form
    $editedData = [
        'Email' => $_POST['email'],
        'Gender' => $_POST['gender'],
        'DateOfBirth' => $_POST['dateOfBirth'],
        'ContactNumber' => $_POST['contactNumber'],
        'Address' => $_POST['address'],
        // Add more fields as needed
    ];

    $userId = $user['PatientID']; // Assuming the user ID is stored in the $user array

    // Define the SQL query to update user data
    $query = "UPDATE Patients SET
                Email = ?,
                Gender = ?,
                DateOfBirth = ?,
                ContactNumber = ?,
                Address = ?
                WHERE PatientID = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($connection, $query);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sssssi', 
        $editedData['Email'],
        $editedData['Gender'],
        $editedData['DateOfBirth'],
        $editedData['ContactNumber'],
        $editedData['Address'],
        $userId
    );
    
    // Execute the statement
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        $successMessage = "Profile updated successfully!";
    } else {
        $successMessage = "Error updating profile: " . mysqli_stmt_error($stmt);
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the profile page after editing
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/css/edit_profile_patient.css">
    <!-- Add other stylesheets or inline styles as needed -->
</head>
<body>
    <!-- Include the header -->
    <?php include_once '../templates/header.php'; ?>

    <div class="container">
        <h2>Edit Profile</h2>

        <!-- Display success message if available -->
        <?php if ($successMessage): ?>
            <p class="success-message"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <form action="edit_profile_patient.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $user['Email']; ?>" required>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="M" <?php echo ($user['Gender'] === 'M') ? 'selected' : ''; ?>>Male</option>
                <option value="F" <?php echo ($user['Gender'] === 'F') ? 'selected' : ''; ?>>Female</option>
            </select>

            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" name="dateOfBirth" value="<?php echo $user['DateOfBirth']; ?>" required>

            <label for="contactNumber">Contact Number:</label>
            <input type="tel" name="contactNumber" value="<?php echo $user['ContactNumber']; ?>" required>

            <label for="address">Address:</label>
            <textarea name="address" rows="3" required><?php echo $user['Address']; ?></textarea>

            <!-- Add more form fields for other user data as needed -->

            <button type="submit">Save Changes</button>
        </form>
    </div>

    <!-- Include the footer -->
    <?php include_once '../templates/footer.php'; ?>

</body>
</html>
