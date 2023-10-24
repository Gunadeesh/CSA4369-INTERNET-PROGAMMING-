<?php
// Database connection details
$host = 'localhost';        // MySQL host
$username = 'root';         // MySQL username
$password = '';             // MySQL password
$database = 'agentsregister'; // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $agentName = $_POST['agent_name'];
    $companyName = $_POST['company_name'];

    // Insert the data into the table
    $sql = "INSERT INTO agentsandcompanies(agent_name, company_name) VALUES ('$agentName', '$companyName')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to agents.html
        header("Location: agents.html");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
