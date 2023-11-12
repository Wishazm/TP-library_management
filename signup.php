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
            padding:15px;
            border-radius:5px;
            border:1px solid #ddbea9;
            margin-bottom:10px;
        }
        button{
            width:102%;
            border:none;
            padding:15px;
            color:#457b9d;
            background-color:#a8dadc;
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
        <form style=" margin:0 auto;place-items: center; transform: translateY(-15%);" action="add.php" method="post" id="loginForm">
            <div ><h1>Sign up</h1>
            <div style="display:flex;gap:2%;"><input  type="text" name="firstname" placeholder="First name" required ><input type="text" name="familyname" placeholder="Family name" required ><br></div>
            <input type="email" placeholder="Email" name="email" style="width:94%;">
            <input type="text" placeholder="username" name="username" style="width:94%;">
            <div style="display:flex;gap:2%;"><input style="" type="phone" name="phone" placeholder="Phone" required ><input  type="password" name="password" placeholder="Password" required ><br></div>
            
            <input type="submit" value="Log in" name="submit" style="width:102%;
                    border:none;
                    padding:15px;
                    color:#457b9d;
                    background-color:#a8dadc;
                    border-radius:5px;"
                    onclick="go()">
        </form>
        <span style="font-size:15px;color:grey;">Already have an account!<a style="color:#a8dadc;" href="login.php">Log in</a></span>
    </main>   
</body>
</html> 
