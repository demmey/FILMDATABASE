<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Poster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/update_poster.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="view_films.php">Back to Films</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Update Poster</h2>
        <form action="update_poster.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="film_id">Film ID:</label>
                <input type="text" id="film_id" name="film_id" required>
            </div>
            <div class="form-group">
                <label for="poster_image">Poster Image:</label>
                <input type="file" id="poster_image" name="poster_image" required>
            </div>
            <button type="submit" class="submit-btn" name="update_poster">Update Poster</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2023 FilmFlix. All rights reserved.</p>
    </footer>

    <?php
    // Check if the form was submitted
    if (isset($_POST['update_poster'])) {
        // Get the form data
        $film_id = $_POST["film_id"];
        $poster_image = $_FILES["poster_image"];

        // Validate the form data
        if (empty($film_id) || empty($poster_image["name"])) {
            echo "Please fill in all the required fields.";
            exit;
        }

        // Set the directory where the uploaded files will be stored
        $upload_dir = "../img/";
        $upload_file = $upload_dir . basename($poster_image["name"]);

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($poster_image["tmp_name"], $upload_file)) {
            // Update the poster image in the database
            $servername = "localhost";
            $username = "demelvio";
            $password = "demmey_2006";
            $dbname = "filmdatabase";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                error_log("Database connection failed: " . $conn->connect_error);
                echo "Error connecting to the database.";
                exit;
            }

            $sql = "UPDATE films SET poster = ? WHERE film_id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                error_log("Prepare statement failed: " . $conn->error);
                echo "Error preparing the statement.";
                $conn->close();
                exit;
            }

            $poster_filename = basename($poster_image["name"]);
            $stmt->bind_param("si", $poster_filename, $film_id);

            if (!$stmt->execute()) {
                error_log("Execute statement failed: " . $stmt->error);
                echo "Error updating the poster image.";
                $stmt->close();
                $conn->close();
                exit;
            }

            echo "Poster image updated successfully.";
            $stmt->close();
            $conn->close();
        } else {
            error_log("Error uploading the file: " . print_r($_FILES["poster_image"], true));
            echo "Error uploading the file.";
        }
    }
    ?>
</body>
</html>
