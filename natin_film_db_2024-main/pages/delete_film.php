
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Check if film ID is set and not empty
    if(isset($_POST['film_id']) && !empty($_POST['film_id'])) {
        // Get film ID from the form submission
        $film_id = $_POST['film_id'];

        // Database connection
        $servername = "localhost";
        $username = "demelvio";
        $password = "demmey_2006";
        $dbname = "filmdatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL statement to delete the film
        $sql = "DELETE FROM films WHERE film_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $film_id);
        $stmt->execute();

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Redirect back to the page after deletion
        header("Location: delete_film.php");
        exit();
    } else {
        echo "Film ID not provided.";
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
    <button class="btn" onclick="location.href='edit_film.php'">Update Film</button>
    <button class="btn" onclick="location.href='add_film.php'">Add Film</button>
</div>
    </nav>
    </header>
<h2>Delete Film</h2>
<form action="delete_film.php" method="post">
    <label for="delete_id">Film ID to Delete:</label><br>
    <input type="number" id="delete_id" name="film_id" required><br><br>
    <input type="submit" value="Delete" name="delete">
    
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
</html>
