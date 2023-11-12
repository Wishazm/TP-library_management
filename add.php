<?php
$host = 'localhost';
$username = 'root';
$password = '1234'; 
$database = 'library';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$saveStatus = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $familyname = $_POST['familyname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; 

    $sql = "INSERT INTO users (firstname, familyname, email, phone) VALUES ('$firstname', '$familyname', '$email', '$phone')";

    if (mysqli_query($connection, $sql)) {
        $user_id = mysqli_insert_id($connection); 
        $password_hash = password_hash($password, PASSWORD_DEFAULT); 

        $login_sql = "INSERT INTO login (firstname, password) VALUES ( '$firstname', '$password_hash')";

        if (mysqli_query($connection, $login_sql)) {
            $saveStatus = 'User info and login added successfully!';
        } else {
            $saveStatus = 'Error adding login info: ' . mysqli_error($connection);
        }
    } else {
        $saveStatus = 'Error adding user info: ' . mysqli_error($connection);
    }
}
mysqli_close($connection);
?>

<script>
    alert("<?php echo $saveStatus; ?>");
    window.history.back();
</script><?php
$host = 'localhost';
$username = 'root';
$password = '1234'; 
$database = 'library';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$saveStatus = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $familyname = $_POST['familyname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $sqlUsers = "INSERT INTO users (firstname, familyname, email, username, phone) VALUES ('$firstname', '$familyname', '$email','$username', '$phone')";

    if (mysqli_query($connection, $sqlUsers)) {
        $userId = mysqli_insert_id($connection);

        $usertype = "user"; 
        $sqlLogin = "INSERT INTO login (username, password, usertype) VALUES ('$username', '$password', 'user')";

        if (mysqli_query($connection, $sqlLogin)) {
            $saveStatus = 'User info added successfully!';
        } else {
            $saveStatus = 'Error adding user info to login table: ' . mysqli_error($connection);
        }
    } else {
        $saveStatus = 'Error adding user info to users table: ' . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<script>
    alert("<?php echo $saveStatus; ?>");
    window.history.back();
</script>

