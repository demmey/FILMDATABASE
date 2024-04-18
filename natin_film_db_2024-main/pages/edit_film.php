


<?php
// Database connection
$servername = "localhost";
$username = "demelvio";
$password = "demmey_2006";
$dbname = "filmdatabase";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update Operation (Edit Film)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_film'])) {
    // Check if film_id is set
    if (isset($_POST['film_id'])) {
        $film_id = $_POST['film_id'];
    } else {
        echo "Error: Film ID is missing";
        exit();
    }

    // Retrieve other form data and sanitize inputs
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
    $director = isset($_POST['director']) ? mysqli_real_escape_string($conn, $_POST['director']) : '';
    $release_year = isset($_POST['release_year']) ? mysqli_real_escape_string($conn, $_POST['release_year']) : '';
    $genre = isset($_POST['genre']) ? mysqli_real_escape_string($conn, $_POST['genre']) : '';

    // Validate form data (you can add more validation as needed)
    if (empty($title) || empty($director) || empty($release_year) || empty($genre)) {
        echo "Please fill in all the required fields.";
        exit();
    }

    // Update query using prepared statement
    $stmt = $conn->prepare("UPDATE films SET titel=?, director=?, release_year=?, genre=? WHERE film_id=?");
    $stmt->bind_param("ssssi", $title, $director, $release_year, $genre, $film_id);

    if ($stmt->execute()) {
        echo "Film updated successfully";
    } else {
        echo "Error updating film: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="view_films.php">FilmFlix</a>
            </div>
            <div class="button-container">
    <button class="btn" onclick="location.href='delete_film.php'">Delete Film</button>
    <button class="btn" onclick="location.href='add_film.php'">Add Film</button>
</div>
        </nav>
    </header>

    <h2>Update Film</h2>

    <form method="post" action="edit_film.php">
    <label for="film_id">Film ID:</label><br>
    <input type="text" id="film_id" name="film_id"><br>
    <label for="title">(New)Title:</label><br>
    <input type="text" id="title" name="title"><br>
    <label for="director">(New)Director:</label><br>
    <input type="text" id="director" name="director"><br>
    <label for="release_year">(New)Release Year:</label><br>
    <input type="text" id="release_year" name="release_year"><br>
    <label for="genre">(New)Genre:</label><br>
    <input type="text" id="genre" name="genre"><br>
    <input type="submit" name="edit_film" value="Update Film">
</form>

</footer>

<style>
    .footer {
        background-color: #333;
        color: #fff;
        padding: 40px 0;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-info h3, .footer-contact h3 {
        margin-bottom: 20px;
    }

    .contact-icons {
        list-style: none;
        display: flex;
        justify-content: center;
    }

    .contact-icons li {
        margin: 0 10px;
    }

    .contact-icons a {
        color: #fff;
        font-size: 24px;
        transition: color 0.3s ease;
    }

    .contact-icons a:hover {
        color: #ccc;
    }
</style>
</body>
</html>