<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function deleteCategory($conn, $categoryId) {
    $categorySlugQuery = "SELECT categoryslug FROM category WHERE id = $categoryId";
    $categorySlugResult = $conn->query($categorySlugQuery);
    
    if ($categorySlugResult->num_rows > 0) {
        $row = $categorySlugResult->fetch_assoc();
        $categorySlug = $row["categoryslug"];
        
        $deleteCategoryQuery = "DELETE FROM category WHERE id = $categoryId";
        if (!$conn->query($deleteCategoryQuery)) {
            echo "Error deleting from category: " . $conn->error;
            return; 
        }
        $dropTableQuery = "SELECT CONCAT('DROP TABLE IF EXISTS ', table_name) AS query
                           FROM information_schema.tables
                           WHERE table_schema = 'library' AND table_name LIKE '%$categorySlug%'";
        
        $dropTableResult = $conn->query($dropTableQuery);
        
        if ($dropTableResult) {
            while ($row = $dropTableResult->fetch_assoc()) {
                $dropQuery = $row['query'];
                $conn->query($dropQuery); 
            }
        } else {
            echo "Error dropping tables: " . $conn->error;
        }
    }
}



function editCategory($conn, $categoryId, $newCategoryName, $newCategorySlug) {
    $updateCategoryQuery = "UPDATE category SET categoryname = '$newCategoryName', categoryslug = '$newCategorySlug' WHERE id = $categoryId";
    $conn->query($updateCategoryQuery);
    
    $updateOtherTableQuery = "UPDATE other_table SET some_column = '$newCategoryName' WHERE categoryslug = '$newCategorySlug'";
    $conn->query($updateOtherTableQuery);
}

if (isset($_POST["delete"])) {
    $categoryId = $_POST["delete"];
    deleteCategory($conn, $categoryId);
}

if (isset($_POST["edit"])) {
    $categoryId = $_POST["edit"];
    $newCategoryName = $_POST["new_category_name"];
    $newCategorySlug = $_POST["new_category_slug"];
    editCategory($conn, $categoryId, $newCategoryName, $newCategorySlug);
}

$query = "SELECT id, categoryname, categoryslug FROM category";
$result = $conn->query($query);
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
    <style>  
        table, td, th {
            border: 1px solid;
            padding: 10px;
        }
        .edit{
            padding:5px;
            border-radius:5px;
            width:17%;
            background-color:#2b9348;
            color:white;
            border:none;
        }
        .edit_input{
            padding:5px;
            border-radius:5px;
            border:grey;
            width:35%;
        }
        table{
            width:100%;
            border-collapse: collapse;
        }
        .delete{
            background-color:#d00000;
            border-radius:5px;
            border:none;
            color:white;padding:5px;
            width:100%;
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
            <li><a  href="addCategory.php"><img src="imgs/addCategory.png" alt="">Add Categoty</a></li>
            <li><a style="border-left:3px #8E8E8E solid;" href="viewCategory.php"><img src="imgs/category.png" alt="">View Category</a></li>
            <li><a href="addBooks.php"><img src="imgs/addBook.png" alt=""> Add books</a></li>
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
        <h1 style="color:#457b9d;">View Category</h1>
        <table class="table table-stripped">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Category Slug</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["categoryname"] . "</td>";
                echo "<td>" . $row["categoryslug"] . "</td>";
                echo '<td><form method="post"><button class="delete" type="submit" name="delete" value="' . $row["id"] . '">Delete</button></form></td>';
                echo '<td>
                        <form method="post">
                            <input class="edit_input" type="text" name="new_category_name" placeholder="New Name">
                            <input class="edit_input" type="text" name="new_category_slug" placeholder="New Slug">
                            <button class="edit" type="submit" name="edit" value="' . $row["id"] . '">Edit</button>
                        </form>
                    </td>';
                echo "</tr>";
            }
        }
        ?>
    </table>
    <?php
    $conn->close();
    ?>
    </div>
</body>
</html>