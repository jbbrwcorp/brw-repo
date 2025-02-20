<?php
// Assume you have already connected to your database (include your config.php)
include 'config.php';

// Example data (in real life, you'll get these from a registration form)
$username = 'jb';
$plainPassword = 'brwcorp020828'; // The password the user entered
$role = 'admin'; // This can be 'admin', 'manager', or 'worker'

// Hash the plain text password using PHP's password_hash function.
// PASSWORD_DEFAULT uses the current best algorithm.
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// Now, insert this new user into the database using a prepared statement
$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("sss", $username, $hashedPassword, $role);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
