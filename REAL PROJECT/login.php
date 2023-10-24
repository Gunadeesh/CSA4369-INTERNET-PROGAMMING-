<?php
session_start();

// Database connection details
$host = 'localhost';        // MySQL host
$username = 'root';         // MySQL username
$password = '';             // MySQL password
$database = 'logindata';    // MySQL database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify username and password in the database
    $sql = "SELECT username, password FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $dbPassword);

    if ($stmt->fetch() && password_verify($password, $dbPassword)) {
        // Login successful, set a session variable to indicate the user is logged in
        $_SESSION['username'] = $username;
        header("Location: search.html");
        exit;
    } else {
        echo "Login failed. Please check your username and password.";
    }
}

// Close the database connection
$conn->close();
?>
