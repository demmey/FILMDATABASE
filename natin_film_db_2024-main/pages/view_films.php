<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilmFlix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/view_films.css">
</head>
<body>
    <header>
        <div class="logo"></div>
        <img src="../img/logo.png" alt="Logo">
       
        <nav>
        <ul>
    <li><a href="update_poster.php">Edit/Update Film Posters</a></li>
    <li>
        <a href="#">Films</a>
        <ul>
            <li><a href="add_film.php">Add Films</a></li>
            <li><a href="delete_film.php">Delete Films</a></li>
            <li><a href="edit_film.php">Update Films</a></li>
        </ul>
    </li>
</ul>
        </nav>
    </header>
    <main>
        <h2>Popular Movies</h2>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search movies...">
            <button id="searchButton">Search</button>
        </div>
        <div class="movie-grid" id="movieGrid">
            <?php
          // Database connection
$servername = "localhost";
$username = "demelvio";
$password = "demmey_2006";
$dbname = "filmdatabase";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read Operation (View Films with Ratings)
$sql = "SELECT f.*, fr.Beoordeling AS rating FROM films f LEFT JOIN filmratings fr ON f.film_id = fr.film_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Set default poster image
        $posterImage = '../img/blank.jpg';

        // Define custom poster images based on film ID
        $customPosterImages = [
            9 => '../img/MORTALKOMBAT.jpg',
            10 => '../img/TRANSFORMERS.jpg',
            11 => '../img/saw_X.jpeg',
            12 => '../img/susuk.jpg',
            13 => '../img/sharktale.jpg',
            14 => '../img/spongbob.jpg',
            15 => '../img/CREED.jpg',
            16 => '../img/Rocky 2.jpg',
            17 => '../img/inception.jpg',
            18 => '../img/the god father.jpg',
            19 => '../img/saw_x.jpeg',
            20 => '../img/default_image.jpg', // Default image for film ID 20
            21 => '../img/rocky.jpg',
            22 => '../img/rockyIII.jpg' ,// Default image for film ID 21
            
            
            
        ];

        // Check if film ID has a custom poster image
        if (isset($customPosterImages[$row["film_id"]])) {
            $posterImage = $customPosterImages[$row["film_id"]];
        }

        // Output movie card HTML with poster image
        echo '<div class="movie-card">';
        echo '<img src="../img/' . htmlspecialchars($row["poster"]) . '" alt="' . htmlspecialchars($row["titel"]) . ' Poster">';

        echo '<div class="movie-info">';
        echo '<h3 class="movie-title">' . htmlspecialchars($row["titel"]) . '</h3>';
        echo '<p class="movie-rating">' . ($row["rating"] !== null ? $row["rating"] : "N/A") . '</p>';
        echo '<div class="movie-actions">';
        echo '<a href="watch.php?id=' . $row["film_id"] . '" class="watch-btn">Watch</a>';
        echo '<a href="edit_film.php?id=' . $row["film_id"] . '" class="edit-btn">Edit</a>';
        echo '</div>';
        echo '<div class="rating">';
        echo '<span class="star" data-value="1">&#9734;</span>';
        echo '<span class="star" data-value="2">&#9734;</span>';
        echo '<span class="star" data-value="3">&#9734;</span>';
        echo '<span class="star" data-value="4">&#9734;</span>';
        echo '<span class="star" data-value="5">&#9734;</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();

            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 FilmFlix. All rights reserved.</p>
    </footer>
    <script src="../js/view_films.js"></script>
</body>
</html>