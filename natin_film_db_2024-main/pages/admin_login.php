<?php
session_start();

$servername = "localhost";
$username = "demelvio";
$mail="demmey15@gmail.com";
$password = "demmey_2006";
$dbname = "filmdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM admins WHERE mail = '$mail' AND Pass = '$pass'";
    $result = $conn->query($sql);

    if (!$row = $result->fetch_assoc()) {
        // Display a popup message
        echo "<script>alert('Incorrect username or password');</script>";
        // Redirect back to the login page after the alert is dismissed
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'admin_login.php';
                }, 0.1); // Redirect after 0.1 second
              </script>";
    } else {
        $_SESSION['Admin_id'] = $row['Admin_id'];
        // Display a popup message and redirect to homepage.php after a short delay
        echo "<script>alert('Login successful. Redirecting to login page...');</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'home.php'; }, 1000);</script>"; // Redirect after 2 seconds
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Film Rating Website - Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="mail" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
       
    </div>
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
