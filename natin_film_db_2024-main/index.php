<?php
session_start();
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

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $mail = sanitize_input($_POST['mail']);
    $pass = sanitize_input($_POST['pass']);

    // Check if user with the provided email already exists
    $check_query = "SELECT * FROM users WHERE mail = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $mail);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('User with this email already exists');</script>";
    } else {
        // Insert new user into the database using prepared statement
        $insert_query = "INSERT INTO users (mail, Pass) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ss", $mail, $pass);

        if ($insert_stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $insert_stmt->error;
        }
    }
}

// Process login form
// Add your login code here
// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $mail = sanitize_input($_POST['mail']);
    $pass = sanitize_input($_POST['pass']);

    // Check if user exists with the provided email and password
    $login_query = "SELECT * FROM users WHERE mail = ? AND Pass = ?";
    $login_stmt = $conn->prepare($login_query);
    $login_stmt->bind_param("ss", $mail, $pass);
    $login_stmt->execute();
    $login_result = $login_stmt->get_result();

    if ($login_result->num_rows == 1) {
        // User authenticated, start session and redirect
        $_SESSION['logged_in'] = true;
        // You can also store other user information in session if needed
        // $_SESSION['user'] = $login_result->fetch_assoc();
        header("Location: users_homepage/text/html.homepage.html"); // Redirect to the dashboard page after successful login
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Film Rating Website - Login</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="mail" placeholder="Email address" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="mail" placeholder="Email address" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="register">Sign Up</button>
        </form>
        <p>Or <a href="pages/admin_login.php">Login as admin</a></p>
    </div>
</body>
</html>
