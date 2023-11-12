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
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="imgs/logo.png" alt="logo"><h3>ookStore</h3>        
        </div>
        
        <ul class="sidebar-menu">
            <li ><a style="border-left:3px #8E8E8E solid;" href="admin.php" ><img src="imgs/Home.png" alt="" >Home</a></li>
            <li><a href="addCategory.php"><img src="imgs/addCategory.png" alt="">Add Categoty</a></li>
            <li><a href="viewCategory.php"><img src="imgs/category.png" alt="">View Category</a></li>
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
        <h1 style="color:#457b9d;">Home</h1>
    </div>
</body>
</html>