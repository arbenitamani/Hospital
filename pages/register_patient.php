<?php
function sanitize_input($input) {
    // Remove leading and trailing whitespaces
    $input = trim($input);

    // Remove backslashes
    $input = stripslashes($input);

    // Convert special characters to HTML entities
    $input = htmlspecialchars($input);

    return $input;
}

include_once '../includes/db_connection.php';
include_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registerPatient'])) {
    // Form is submitted, process the data
    $firstName = sanitize_input($_POST['firstName']);
    $lastName = sanitize_input($_POST['lastName']);
    $gender = sanitize_input($_POST['gender']);
    $dob = sanitize_input($_POST['dob']);
    $contactNumber = sanitize_input($_POST['contactNumber']);
    $address = sanitize_input($_POST['address']);
    $email = sanitize_input($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert data into the Patients table
    $query = "INSERT INTO Patients (FirstName, LastName, Gender, DateOfBirth, ContactNumber, Address, Email, Password)
              VALUES ('$firstName', '$lastName', '$gender', '$dob', '$contactNumber', '$address', '$email', '$password')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Patient registration successful!";
        // Redirect to prevent form resubmission
        header("Location: register_patient.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="../assets/css/register_patient.css">
</head>
<body>


    <div class="container">
        <h2>Patient Registration</h2>
        <form action="register_patient.php" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" required>

            <label for="contactNumber">Contact Number:</label>
            <input type="tel" name="contactNumber" required>

            <label for="address">Address:</label>
            <textarea name="address" rows="3" required></textarea>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmPassword" required>

            <button type="submit" name="registerPatient">Register</button>
        </form>
    </div>

    <?php include_once '../templates/footer.php'; ?>
</body>
</html>
