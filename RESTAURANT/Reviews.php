<!DOCTYPE html>
<html>
<head>
    <title>REVIEW'S</title>
    <!-- Add your CSS link here if you want to style the display page -->
</head>
<body>
<marquee behavior="alternate">
       <h1 class="id">REVIEW'S</h1>
</marquee> 

<?php
// Establish a database connection (similar to your form processing PHP)
$db_host = "localhost";     // Replace with your database host
$db_user = "root";     // Replace with your database username
$db_password = ""; // Replace with your database password
$db_name = "contactinformation";     // Replace with your database name
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch and display the submitted data
$sql = "SELECT * FROM contact"; // Assuming the table is named 'contacts'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th><th>Message</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["message"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '<button onclick="window.location.href=\'main.html\'">Home</button>'; // Home button
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>
