
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="imgs/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/logo.png">
    <style>
        .shop-feature{
            color: brown;
            border-bottom: 1px solid brown;
        }
        .home-feature, .about-feature{
            color: black;
        }
        .home-feature:hover, 
        .about-feature:hover{
            color: brown;
            border-bottom: 1px solid brown ;
        }
        .book-details{
            display: flex;
            padding: 90px;
            gap: 60px;
        }
        .book-details-image{
            width: 33%;
        }
        .book-details-image img{
            width: 100%;
            border: 5px solid brown ;
            border-radius: 10px;
        }
        .book-details-content{
            width: 67%;
            margin: 0;
        }

        .book-quantity{
            display: flex;
            gap: 10px;
            /* justify-content: space-between; */
        }
        .add-button{
            color:white;
            background-color: brown;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 20%;
            margin-left: 10px;
        }
        .quantity{
            padding: 10px;
            border-radius: 5px;
            border: 1px solid brown ;
            width: 10%;
        }
       
    </style>
</head>
<body>
    <div class="container">
        <div class="sold-div">
            <div class="space-div">
                <span class="sold">FREE SHIPPING FOR ORDERS OVER $50</span>
                <span class="icon">
                    <img src="imgs/twitter.png" alt="twitter">
                    <img src="imgs/instagram.svg" alt="instagram">
                    <img src="imgs/facebook-f.svg" alt="facebook">
                </span>
            </div>
        </div>
        
        <main>
        <div class="new-menu">
            <span>
                <img src="imgs/logo.png" alt="logo">
            </span>
            <span class="features">
                <div class="menu-item">
                    <a class="home-feature" href="home.php">Home</a>
                </div>
                <div class="menu-item">
                    <a class="shop-feature" href="shop.php">Shop </a>
                </div>
                <div class="menu-item">
                    <a class="about-feature" href="#">About </a>
                </div>
            </span>
            
            <span class="new-menu-icon">
                <img src="imgs/magnifying-glass-solid.svg" alt="search">
                <a href="#" class="openSidebar"><img src="imgs/bars-solid.svg" alt="bar"></a>
            </span>
                
        </div>
        </main>
        <div class="shop-img-div">
            <img src="imgs/shop.jpg" alt="shop-img" class="shop-img">
            <div class=" parag">PRODUCTS</div>
            <div class="text">Details</div>
        </div>

               
        <?php
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];
    
    // Connect to the database and retrieve book details based on $bookId
    $host = "localhost";
    $username = "root";
    $password = "1234";
    $database = "library";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM bookslist WHERE id = $bookId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $bookDetails = $result->fetch_assoc();
        echo '<div class="book-details">' ;
            echo '<div class="book-details-image">';
                echo '<img src="' . $bookDetails['bookimage'] . '" alt="' . $bookDetails['bookname'] . '">';
            echo '</div>';
            echo '<div class="book-details-content">';
                echo '<span>By ' . $bookDetails['author'] . '</span>';
                echo '<h1>' . $bookDetails['bookname'] . '</h1>';
                echo '<p>Price: ' . $bookDetails['price'] . '</p>';
                echo '<p>' . $bookDetails['description'] . '</p>';
                echo '<div >';
            echo '</div class="book-quantity">';
                echo'<input class="quantity" type="number" placeholder="Quantity">';
                echo '<input class="add-button" type="submit" value="Add">';
            echo '</div>';
        echo '</div>';
    } else {
        echo 'Book not found.';
    }
    $conn->close();
} else {
    echo 'Book ID not provided.';
}
?>

        <!--footer-->
        <footer>
            <div>
                <span class="footer-title">Publishers</span><br>
                <a href="#">Bestsellers</a><br>
                <a href="#">Interviews</a><br>
                <a href="#">Authors Story</a> <br>
                <a href="#">Book Fairs</a> <br>
                <a href="#">Help (FAQ)</a>
            </div>
            <div>
                <span class="footer-title">Contact</span>
                <p>Stay in touch with everything ChapterOne, follow us on social media and learn about new promotions.</p>
                <span class="icon">
                    <img src="imgs/twitter.png" alt="twitter">
                    <img src="imgs/instagram.svg" alt="instagram">
                    <img src="imgs/facebook-f.svg" alt="facebook">
                </span>
            </div>
            <div>
                <span class="footer-title">News & Update</span>
                <p>We’d love it if you subscribed to our newsletter! You’ll love it too.</p>
                <input type="email" name="email" id="email" placeholder="Email...">
            </div>
            <div class="footer-container">
                <span class="footer-title">Social media</span>

                <div class="social-media">
                    <div class="row">
                        <img src="imgs/pexels-erik-mclean-7524996.jpg" alt="">
                        <img src="imgs/pexels-cottonbro-studio-7703304.jpg" alt="">
                        <img src="imgs/pexels-alina-vilchenko-1173648.jpg" alt="">
                    </div>
                    <div class="row row-two">
                        <img src="imgs/pexels-erik-mclean-7524996.jpg" alt="">
                        <img src="imgs/pexels-cottonbro-studio-7703304.jpg" alt="">
                        <img src="imgs/pexels-alina-vilchenko-1173648.jpg" alt="">
                    </div>
                </div>


            </div>
        </footer>
        <nav>© 2023 QODE INTERACTIVE, ALL RIGHTS RESERVED</nav>
    </div>
</body>
</html>
    