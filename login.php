<?php
$host="localhost";
$user="root";
$password="1234";
$db="library";

session_start();

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
  die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $username=$_POST["username"];
  $password=$_POST["password"];

  $sql="select * from login where username='".$username."'AND password='".$password."'";
  
  $result=mysqli_query($data,$sql);

  $row=mysqli_fetch_array($result);

  if($row["usertype"]=="user")
  { 
    $_SESSION["username"]=$username;
    header("location:home.php");
  }

  elseif($row["usertype"]=="admin")
  {
    $_SESSION["username"]=$username;
    header("location:admin.php");
  }

  else
  {
    echo '<script>alert("username or password incorrect")</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/logo.png">
    <title>Books | library</title>
    <style>
        h1{
            color:#457b9d;
        }
        input{
            width:100%;
            padding:15px;
            border-radius:5px;
            border:1px solid #ddbea9;
            margin-bottom:10px;
            transition: .3s;
        }
        button{
            width:110%;
            border:none;
            padding:15px;
            color:white;
            background-color:brown;
            border-radius:5px;
        }
        button:hover{
            background-color:#8ecae6;
            transition:.5s;
        }
        main{
            display: grid;
            width: 100%;
        }
        a:hover{
            color:#8ecae6;
        }
    </style>
</head>
<body>
    <main>
    <nav><img src="imgs/logo.png" alt="logo" style="padding:20px;"></nav>
        
        <form action="" name="form" style=" margin:0 auto;place-items: center; transform: translateY(-15%);" method="post" id="form">
            <div style="margin:0 auto;"><h1>Log in</h1>
            <input type="text" id="username" name="username" placeholder="Username"  required><br>
            <input type="password" id="password" name="password" placeholder="Password" required  ><br>
            <div id="error" ></div>
            <input
            style="width:110%;
                    border:none;
                    padding:15px;
                    color:#457b9d;
                    background-color:#a8dadc;
                    border-radius:5px;"
             type="submit" name="submit" id="submit" type="submit" value="Submit">
        </form>
        <span style="font-size:15px;color:grey;">Don't have an account! <a style="color:#a8dadc;" href="signup.php">Create here</a></span>
       
    </main>   
</body>
</html> 