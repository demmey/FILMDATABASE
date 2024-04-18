<?php
// Database connection details
$servername = "localhost";
$username = "demelvio";
$password = "demmey_2006";
$dbname = "filmdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the search term from the GET request
$searchTerm = $_GET['searchTerm'];

// Prepare and execute the SQL query to fetch movies based on the search term
$sql = "SELECT film_id, titel, director, genre, poster FROM films WHERE titel LIKE '%$searchTerm%'";
$result = $conn->query($sql);

$movies = array();

// Fetch the results and store them in an array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movie = array(
            "film_id" => $row["film_id"], // Include movie ID for editing
            "title" => $row["titel"],
            "director" => $row["director"],
            "genre" => $row["genre"],
            "poster" => "../img/" . $row["poster"] // Construct the poster URL
        );
        $movies[] = $movie; // Add the movie to the $movies array
    }
}

// Output movie cards with edit button
foreach ($films as $movie) {
 
   
}

// Close the database connection
$conn->close();


// Send the movies data as a JSON response
header('Content-Type: application/json');
echo json_encode($movies);
?>
