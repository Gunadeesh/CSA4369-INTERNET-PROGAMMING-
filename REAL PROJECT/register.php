<?php
// Database connection details
$host = 'localhost';        // MySQL host
$username = 'root'; // MySQL username
$password = ''; // MySQL password
$database = 'logindata'; // MySQL database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to securely hash the password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = hashPassword($_POST['password']);

    $sql = "INSERT INTO users(username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful. You can now log in.";
      echo '<form method="post" action="login.html"><br>';
      echo '<input type="submit" name="submit" value="Submit">'; 
      echo '</form>';

    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
