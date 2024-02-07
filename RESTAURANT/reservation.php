<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection details
    $db_host = "localhost";     // Replace with your database host
    $db_user = "root";     // Replace with your database username
    $db_password = ""; // Replace with your database password
    $db_name = "reservation";     // Replace with your database name

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form input values
    $date = $conn->real_escape_string($_POST["date"]);
    $time = $conn->real_escape_string($_POST["time"]);<?php
    $guests = $conn->real_escape_string($_POST["guests"]);

    // SQL query to insert data into a "reservations" table
    $sql = "INSERT INTO reservations (reservation_date, reservation_time, num_guests) VALUES ('$date', '$time', '$guests')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you! Your reservation has been successfully booked.</p>";
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
