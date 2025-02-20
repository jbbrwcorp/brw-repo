<?php
// 1. Include your database configuration file (config.php).
include 'config.php';  // Make sure config.php is in the same folder.

// 2. Sanitize the incoming data (title, description) from the form.
//    These names must match the form fields exactly: "title" and "description".
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

// 3. If either title or description is empty, stop and show a message.
if (empty($title) || empty($description)) {
    die("Title or description is missing. Please go back and fill the form.");
}

// 4. Prepare an SQL statement with placeholders.
$sql = "INSERT INTO bids (title, description) VALUES (?, ?)";

// 5. Prepare the statement on the database connection.
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// 6. Bind the parameters (both are strings, so we use "ss").
$stmt->bind_param("ss", $title, $description);

// 7. Execute the statement.
if ($stmt->execute()) {
    echo "Record inserted successfully!";
} else {
    echo "Error executing statement: " . $stmt->error;
}

// 8. Close the statement and the connection.
$stmt->close();
$conn->close();
?>
