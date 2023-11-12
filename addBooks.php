<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $bookName = $_POST['bookname'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "library";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Upload image file
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["bookimage"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["bookimage"]["tmp_name"], $targetFile)) {
        $bookimage = $targetFile;
    } else {
        echo "Image upload failed.";
        $conn->close();
        exit;
    }

    // Insert book information into the category-specific table
    $tableName = strtolower($category);
    $insertIntoCategorySQL = "INSERT INTO $tableName (bookname, author, price, quantity, description, bookimage) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertIntoCategorySQL);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $bookName, $author, $price, $quantity, $description, $bookimage);

    if ($stmt->execute()) {
        // Insert book information into the "book" table
        $insertIntoBookSQL = "INSERT INTO bookslist (bookname, author, price, quantity, description, bookimage, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertIntoBookSQL);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssss", $bookName, $author, $price, $quantity, $description, $bookimage, $category);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Book added successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to add Book to the main book table.";
        }
    } else {
        $_SESSION['error_message'] = "Failed to add Book to the category-specific table.";
    }

    $stmt->close();
    $conn->close();
}
?>



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
    <style>
        input{
            width:100%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            margin-bottom:10px;
            padding:10px;
            border-radius:5px;
            border:none;
        }
        #submit, select{
            width:103.5%;
        }
        select{
            margin-bottom:10px;
            padding:9px;
            border-radius:5px;
            border:none;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
        #bookimage{
            background-color:white;
        }
        #submit{
            color:#457b9d;
            background-color:#a8dadc;
        }
        textarea{
            margin-bottom:10px;
            border-radius:5px;
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
            <li><a href="admin.php" ><img src="imgs/Home.png" alt="" >Home</a></li>
            <li><a href="addCategory.php"><img src="imgs/addCategory.png" alt="">Add Categoty</a></li>
            <li><a  href="viewCategory.php"><img src="imgs/category.png" alt="">View Category</a></li>
            <li><a style="border-left:3px #8E8E8E solid;" href="addBooks.php"><img src="imgs/addBook.png" alt=""> Add books</a></li>
            <li><a href="viewBooks.php"><img src="imgs/book.png" alt=""> View Books</a></li>
            <li><a href="viewUsers.php"><img src="imgs/users.png" alt=""> View Users</a></li>
            <li><a href="viewOrders.php"><img src="imgs/orders.png" alt=""> View Orders</a></li>
        </ul>
        <a href="logout.php" class="logout">Logout</a>
       
    </div>
    
    <div class="content">
        <div class="top-nav">
            <h3 style="color:#457b9d;">Admin Panel!</h3>
        </div>
        <div style="width:50%;">
            <h1 style="color:#457b9d;">Add Books</h1>
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
            <form action="addBooks.php" method="POST" enctype="multipart/form-data">
                <script>
                    var errorMessage = "<?php echo $error_message; ?>";
                    if (errorMessage !== "") {
                        alert(errorMessage);
                    }
                </script>
                <input required placeholder="Book Name" type="text" name="bookname" id="bookname"> <br>
                <select name="category" id="category" required>
                    <option value="">---</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "1234";
                $dbname = "library";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT categoryname FROM category";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["categoryname"] . "'>" . $row["categoryname"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
            <input type="text" placeholder="Author" name="author" required>
                <input required placeholder="Enter Price" type="text" name="price" id="price"><br> 
                <input type="number" placeholder="Quantity" name="quantity" required><br>
                <input required type="file" name="bookimage" id="bookimage"><br>
                <textarea required placeholder="Description" name="description" id="description" cols="90" rows="3"></textarea><br>
                <input type="submit" name="submit" id="submit" value="Add">
            </form>     
        </div>
    </div>
</body>
</html>