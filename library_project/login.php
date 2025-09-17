<?php
session_start();
include 'db.php';

$error= '';
if($_SERVER['REQUEST_METHOD']== "POST") {
    $username= $_POST['username'];
    $password= md5($_POST['password']);

    $sql= "SELECT* FROM users WHERE username='$username' AND password='$password' ";
    $result= $conn->query($sql);

    if($result->num_rows ==1) {
        $row= $result->fetch_assoc();
        $_SESSION['id']= $row['id'];
        $_SESSION['username']= $row['username'];
        $_SESSION['role']= $row['role'];

        if($row['role']== 'admin') {
             header("Location: admin_dashboard.php");
        }
        else {
            header("Location: browse.php");
        }
        exit();

    }
    else {
            $error= "Invalid username or password!";
        }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="auth-container">
            <h2>Login</h2>
            <?php if($error) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="text" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>

            <p>Don't have an account? <a href="register.php">Register here.</a></p>
        </div>

    </body>
</html>

