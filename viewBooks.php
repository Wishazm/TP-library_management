<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="imgs/logo.png">
    <style>
        .sidebar {
            background-color:#223843;
            color: #fff;
            width: 250px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: sticky;
        }
        .read-more{
            color:pink;
        }
        .short-description {
        max-height: 100px; 
        overflow: hidden;
        }
        .expanded {
            max-height: none;
        }
        .book-image-cell img {
            max-width: 100px; /* Adjust the width as needed */
            max-height: 140px; /* Adjust the height as needed */
        }
        table, td, th {
        border: 1px solid;
        padding: 10px;
        }
        .edit,.delete{
            padding:5px;
            border-radius:5px;
            width:100px;
            background-color:#2b9348;
            color:white;
            border:none;
            text-decoration:none;
        }
        .delete{
            background-color:#d00000;
        }
        table{
            width:100%;
            border-collapse: collapse;
        }
        /* .delete{
            
            border-radius:5px;
            border:none;
            color:white;padding:5px;
            width:100%;
        } */
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="imgs/logo.png" alt="logo"><h3>ookStore</h3>        
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="admin.php" ><img src="imgs/Home.png" alt="" >Home</a></li>
            <li><a href="addCategory.php"><img src="imgs/addCategory.png" alt="">Add Categoty</a></li>
            <li><a  href="viewCategory.php"><img src="imgs/category.png" alt="">View Category</a></li>
            <li><a href="addBooks.php"><img src="imgs/addBook.png" alt=""> Add books</a></li>
            <li><a style="border-left:3px #8E8E8E solid;"  href="viewBooks.php"><img src="imgs/book.png" alt=""> View Books</a></li>
            <li><a href="viewUsers.php"><img src="imgs/users.png" alt=""> View Users</a></li>
            <li><a href="viewOrders.php"><img src="imgs/orders.png" alt=""> View Orders</a></li>
        </ul>
        <a href="logout.php" class="logout">Logout</a>
       
    </div>
    <div class="content">
        <div class="top-nav">
            <h3 style="color:#457b9d;">Admin Panel!</h3>
        </div>
        <h1 style="color:#457b9d;">View Books</h1>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "library";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $categoryQuery = "SELECT DISTINCT categoryslug FROM category";
        $categoryResult = $conn->query($categoryQuery);

        while ($categoryRow = $categoryResult->fetch_assoc()) {
            $category = $categoryRow['categoryslug'];

            $categoryTableQuery = "SELECT * FROM $category";
            $categoryTableResult = $conn->query($categoryTableQuery);
            $categoryTableResult = $conn->query($categoryTableQuery);
            if (!$categoryTableResult) {
                die("Query failed: " . $conn->error);
}

            echo "<h2>$category</h2>"; 
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Book Image</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>";

            while ($row = $categoryTableResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td class='book-image-cell'><img src='{$row['bookimage']}' alt='Book Image'></td>
                        <td>{$row['bookname']}</td>
                        <td>{$row['author']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['quantity']}</td>
                        <td>
                            <div class='description'>
                                <div class='short-description'>{$row['description']}</div>
                                <a href='#' class='read-more'>Read More</a>
                            </div>
                        </td>
                        <td><a class='edit' href='edit.php?id={$row['id']}'>Edit</a></td>
                        <td><a class='delete' href='delete.php?id={$row['id']}'>Delete</a></td>
                    </tr>";
            }
            echo "</table>";
        }
        $conn->close();
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const readMoreLinks = document.querySelectorAll('.read-more');

                readMoreLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const descriptionDiv = this.parentNode.querySelector('.short-description');
                        descriptionDiv.classList.toggle('expanded');
                        this.textContent = descriptionDiv.classList.contains('expanded') ? 'Read Less' : 'Read More';
                    });
                });
            });
        </script>
    </div>
</body>
</html>