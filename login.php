<?php
session_start();
include 'config.php';

// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from the login form
    $username = $_POST['username'];
    $userInput = $_POST['password'];

    // Prepare a statement to fetch user data based on the username
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user is found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the input password with the hashed password from the database
        if (password_verify($userInput, $user['password'])) {
            // Password is correct. Start a session and store user data.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect to a protected page (e.g., index.php)
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
