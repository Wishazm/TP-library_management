<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $categoryName = $_POST['categoryname'];
    $categorySlug = $_POST['categoryslug'];

    // Insert into category table
    $query = "INSERT INTO category (categoryname, categoryslug) VALUES ('$categoryName', '$categorySlug')";
    $categoryInsertResult = $conn->query($query);

    // Create another table using categoryslug
    $tableQuery = "CREATE TABLE IF NOT EXISTS $categorySlug (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    bookname VARCHAR(255),
                    author VARCHAR(255),
                    price VARCHAR(10),
                    quantity VARCHAR(20),
                    bookimage VARCHAR(255),
                    description VARCHAR(10000))";
    $tableCreateResult = $conn->query($tableQuery);

    // Set success or error messages in session
    if ($categoryInsertResult && $tableCreateResult) {
        $_SESSION['success_message'] = "Category added successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to add category.";
    }

    // Redirect back to the form page
    header("Location: addCategory.php");
    exit();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var message = <?php echo json_encode($message); ?>;
        var errorDiv = document.querySelector('.error');

        if (message !== "") {
            errorDiv.textContent = message;
            if (message.includes("added successfully")) {
                errorDiv.classList.add("error-green");
            } else {
                errorDiv.classList.add("error-red");
            }
            errorDiv.style.display = "block";
        }
    });
</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="imgs/logo.png">
<style>
        form{
            margin: auto;
        }
        input{
            width:50%;
            padding:10px;
            border-radius:10px;
            margin-bottom:10px;
            border:none;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }      
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="imgs/logo.png" alt="logo"><h3>ookStore</h3>        
        </div>
        <ul class="sidebar-menu">
            <li ><a href="admin.php" ><img src="imgs/Home.png" alt="" >Home</a></li>
            <li><a style="border-left:3px #8E8E8E solid;" href="addCategory.php"><img src="imgs/addCategory.png" alt="">Add Categoty</a></li>
            <li><a href="viewCategory.php"><img src="imgs/category.png" alt="">View Category</a></li>
            <li><a href="addBooks.php"><img src="imgs/addBook.png" alt=""> Add books</a></li>
            <li><a href="viewBooks.php"><img src="imgs/book.png" alt=""> View Books</a></li>
            <li><a href="viewUsers.php"><img src="imgs/users.png" alt=""> View Users</a></li>
            <li><a href="viewOrders.php"><img src="imgs/orders.png" alt=""> View Orders</a></li>
        </ul>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <div class="content" style="margin:0 auto;">
        <div class="top-nav">
            <h3 style="color:#457b9d;">Admin Panel!</h3>
        </div>
        <div style="width:100%;">
            <h1 style="color:#457b9d;">Add Category</h1>
            <div class="error" id="errorDiv">
                    <?php
                    if (isset($_SESSION['success_message'])) {
                        echo '<script>
                                var errorDiv = document.getElementById("errorDiv");
                                errorDiv.textContent = "' . $_SESSION['success_message'] . '";
                                errorDiv.classList.add("error-green");
                                errorDiv.style.display = "block";
                            </script>';
                        unset($_SESSION['success_message']);
                    } elseif (isset($_SESSION['error_message'])) {
                        echo '<script>
                                var errorDiv = document.getElementById("errorDiv");
                                errorDiv.textContent = "' . $_SESSION['error_message'] . '";
                                errorDiv.classList.add("error-red");
                                errorDiv.style.display = "block";
                            </script>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                </div>
            <form action="addCategory.php" method="post" >
            <script>
                var errorMessage = "<?php echo $error_message; ?>";
                if (errorMessage !== "") {
                    alert(errorMessage);
                }
            </script>
                <input type="text" name="categoryname" placeholder="Category Name" required><br>
                <input type="text" name="categoryslug" placeholder="Category Slug" required> <br>
                <input type="submit" name="submit" value="Add"
                style="width:52%;
                    border:none;
                    padding:15px;
                    color:#457b9d;
                    background-color:#a8dadc;
                    border-radius:5px;">
            </form>
        </div>
    </div>
</body>
</html>