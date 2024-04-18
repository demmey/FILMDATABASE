<?php
// Database connection
$servername = "localhost";
$username = "demelvio";
$mail = "demmey15@gmail.com";
$password = "demmey_2006";
$dbname = "filmdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize confirmation message
$confirmation_message = "";

// Create Operation (Add Film)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_film'])) {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];

    $sql = "INSERT INTO films (titel, director, release_year, genre) VALUES ('$title', '$director', '$release_year', '$genre')";

    if ($conn->query($sql) === TRUE) {
        // Set confirmation message
        $confirmation_message = "New film added successfully";
        // Redirect to avoid resubmission
        header("Location: add_film.php");
        exit(); // Ensure script stops executing after redirection
    } else {
        $confirmation_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="../css/form.css">
</head>
<header>
    <nav>
        <div class="logo">
            <a href="view_films.php">FilmFlix</a>
        </div>
        <div class="button-container">
            <button class="btn" onclick="location.href='delete_film.php'">Delete Film</button>
            <button class="btn" onclick="location.href='edit_film.php'">Update Film</button>
        </div>
    </nav>
</header>
<h2>Add Film</h2>
<!-- Display confirmation message -->
<?php if (!empty($confirmation_message)): ?>
    <div><?php echo $confirmation_message; ?></div>
<?php endif; ?>
<form action="add_film.php" method="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br>
    <label for="director">Director:</label><br>
    <input type="text" id="director" name="director" required><br>
    <label for="release_year">Release Year:</label><br>
    <input type="number" id="release_year" name="release_year" required><br>
    <label for="genre">Genre:</label><br>
    <input type="text" id="genre" name="genre" required><br><br>
    <input type="submit" value="Add Film" name="add_film">
</form>


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
</html>
