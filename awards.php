<?php
// Include the database configuration file
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Awards Module</title>
    
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Optional: Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Awards Module</h1>
        
        <!-- Responsive table container -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bid ID</th>
                        <th>Award Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to get awards from the awards table
                    $sql = "SELECT * FROM awards";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['bid_id'] . "</td>";
                            echo "<td>" . $row['award_date'] . "</td>";
                            echo "<td>" . $row['details'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No awards found</td></tr>";
                    }
                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
