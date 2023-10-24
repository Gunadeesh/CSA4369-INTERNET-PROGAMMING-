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

// Retrieve search parameters from the URL
$searchAgent = $_GET['search-agent'];
$searchCompany = $_GET['search-company'];

// Build SQL query based on search parameters
$sql = "SELECT * FROM agentsandcompanies WHERE agent_name LIKE '%$searchAgent%' OR company_name LIKE '%$searchCompany%'";

// Execute the query
$result = $conn->query($sql);

// Start your HTML output
echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Agents and Companies - Online Real Estate Service</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"agentsstyles.css\">
</head>
<body>
    <header>
        <nav>
            <h1>Welcome to Our Real Estate Service</h1>
            <ul>
                <li><a href=\"AGENTS REGISTER.html\">AGENTS REGISTRATION</a></li>
            </ul>
        </nav>
    </header>
    <!-- Search Agents and Companies Section -->
    <section id=\"search-agents-companies\">
        <h2>Search Agents and Companies</h2>
        <form action=\"agents.php\" method=\"GET\">
            <label for=\"search-agent\">Agent Name:</label>
            <input type=\"text\" id=\"search-agent\" name=\"search-agent\">

            <label for=\"search-company\">Company Name:</label>
            <input type=\"text\" id=\"search-company\" name=\"search-company\">

            <button type=\"submit\">Search</button>
        </form>
    </section>
    <!-- Display Search Results -->
    <section id=\"search-results\">
        <h2>Search Results</h2>";
        
// Check if there are results
if ($result->num_rows > 0) {
    echo '<ul>';

    while ($row = $result->fetch_assoc()) {
        echo '<br>';
        echo '<li>';
        echo 'Agent Name: ' . $row['agent_name'] . '<br>';
        echo '<br>';
        echo 'Company Name: ' . $row['company_name'] . '<br>';
        // Add additional fields as needed
        echo '</li>';
    }

    echo '</ul>';
} else {
    echo 'No results found.';
}

// Close the database connection
$conn->close();

// Finish your HTML output
echo "</section>
    <!-- Footer -->
    <footer>
    <br>
    <a href=main.html>HOME PAGE</a>
    <br>
        <p>&copy; 2023 Online Real Estate Service</p>
    </footer>
</body>
</html>";
?>
