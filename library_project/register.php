<?php
session_start();
include 'db.php';

$error= '';
if($_SERVER['REQUEST_METHOD']== "POST") {
    $username= $_POST['username'];
    $password= md5($_POST['password']);

    $check= "SELECT* FROM users WHERE username='$username'";
    $res = $conn->query($check);

    if($res->num_rows >0 ) {
        $error= "Username already exists!";

    }
    else {
        $sql= "INSERT INTO users (username,password) VALUES ('$username','$password')";
        if($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        }
        else{
            $error= "Error: ". $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="auth-container">
            <h2>Register</h2>
            <?php if($error) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="text" name="password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>

            <p>Already registered? <a href="login.php">Login</a></p>
        </div>

    </body>
</html>

