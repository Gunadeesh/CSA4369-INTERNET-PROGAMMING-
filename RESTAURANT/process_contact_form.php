<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection details
    $db_host = "localhost";     // Replace with your database host
    $db_user = "root";     // Replace with your database username
    $db_password = ""; // Replace with your database password
    $db_name = "contactinformation";     // Replace with your database name
    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form input values
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);

    // SQL query to insert data into a "contacts" table
    $sql = "INSERT INTO contact(name, email, message) VALUES ('$name', '$email', '$message')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for your message. We have received your information.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST, do nothing
    echo "<p>Invalid request.</p>";
}
?>
