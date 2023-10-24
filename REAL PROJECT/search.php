<?php
if (isset($_POST['submit'])) {
    // Database connection details
    $host = 'localhost';
    $username = 'root'; // Change this to your database username
    $password = '';     // Change this to your database password
    $database = 'searchinfo';

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $location = $_POST['location'];
    $budget = $_POST['budget'];
    $property_type = $_POST['property_type'];

    // Prepare an SQL insert statement
    $sql = "INSERT INTO details (location, budget, property_type) VALUES ('$location', '$budget', '$property_type')";

    // Execute the insert query
    if ($conn->query($sql) === TRUE) {
        // Fetch and display the data
        $result = $conn->query("SELECT * FROM details WHERE location = '$location' AND budget = '$budget' AND property_type = '$property_type'");

        echo '<ul >';
        echo '<link rel="stylesheet" type="text/css" href="outputstyles.css">';
        while ($row = $result->fetch_assoc()) {
            echo "<br><b> Your Property is available</b><br>";
            echo  "<br>";
            echo '<li>';
            echo 'Location: ' . $row['location'] . '<br>';
            echo 'Budget: ' . $row['budget'] . '<br>';
            echo 'Property Type: ' . $row['property_type'] . '<br>';
            echo '</li>';
            echo  "<br>";
            echo  "<br>";
            echo '<form method="post" action="main.html" class="good"><br>';
            echo '<input type="submit" name="submit" value="GO TO HOME">'; 
            echo '</form>';
        }
        echo '</ul>';
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
