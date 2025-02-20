<?php
session_start();

// Check if the user is logged in and if their role is 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If the user is not an admin, redirect them to a "no access" page.
    header("Location: no-access.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin <?php echo $_SESSION['username']; ?>!</h1>
    <p>This page is only accessible to admins.</p>
</body>
</html>
