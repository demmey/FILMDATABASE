
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Film Database CRUD</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
       
        main {
            flex: 1;
        }
       
        footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
       
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
       
        .button {
            padding: 10px 20px;
            background-color: #f2f2f2;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
       
        .button:hover {
            background-color: #333;
            color: #fff;
        }
       
        h1 {
            font-size: 36px;
            text-align: center;
            transition: color 0.3s, text-decoration 0.3s;
        }
       
        h1:hover {
            color: #D3D3D3;
            text-decoration: underline;
        }
       
        .logo a {
            color:  #D3D3D3;
            text-decoration: none;
            transition: color 0.3s;
        }
       
        .logo a:hover {
            color: #8B8000;
        }
    </style>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="view_films.php">FilmFlix</a>
            </div>
            <ul>
                <!-- Removed the navigation links -->
            </ul>
        </nav>
    </header>
   
    <main>
        <section>
            <h1>Welcome to the admin section</h1>
        
           
            <div class="button-container">
                <a href="delete_film.php" class="button">Delete Film</a>
                <a href="add_film.php" class="button">Add Film</a>
                <a href="edit_film.php" class="button">Update Film</a>
            </div>
        </section>
    </main>
   
    <footer class="footer">
    <div class="footer-content">
        <div class="footer-info">
            <h3>FilmFlix</h3>
            <p>&copy; 2023 All rights reserved.</p>
        </div>
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <ul class="contact-icons">
                <li><a href="https://www.facebook.com/DEMMEY101/"target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fas fa-envelope"></i></a></li>
            </ul>
        </div>
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
</html>