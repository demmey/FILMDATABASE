<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST['film_id']) && isset($_FILES['poster_image'])) {
        // Get film ID from the form
        $film_id = $_POST['film_id'];

        // Database connection parameters
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

        // Process uploaded file
        $poster_image = $_FILES['poster_image'];
        $target_dir = "../img/"; // Specify the directory where you want to save the uploaded posters
        $target_file = $target_dir . basename($poster_image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($poster_image["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($poster_image["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($poster_image["tmp_name"], $target_file)) {
                // Update poster image path in the database
                $sql = "UPDATE films SET poster = ? WHERE film_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $target_file, $film_id);
                if ($stmt->execute()) {
                    echo "The poster has been updated successfully.";
                } else {
                    echo "Error updating poster image: " . $conn->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        // Close database connection
        $conn->close();
    } else {
        echo "Error: All fields are required.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
