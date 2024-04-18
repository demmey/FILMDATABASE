<?php
// Handle the rating submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_POST["film_id"];
    $rating = $_POST["beoordeling"];

    // Database connection
    $servername = "localhost";
    $username = "demelvio";
    $password = "demmey_2006";
    $dbname = "filmdatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the rating in the database
    $sql = "UPDATE filmratings SET Beoordeling = $rating WHERE film_id = $movieId";
    if ($conn->query($sql) === TRUE) {
        echo "Rating updated successfully";
    } else {
        echo "Error updating rating: " . $conn->error;
    }

    $conn->close();
}
?>