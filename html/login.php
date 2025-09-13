<?php
session_start();
include 'db_connect.php';

$error = "";

$librarian_username ="librarian";
$librarian_password ="librarian";

if($_SERVER['REQUEST_METHOD'] ==='POST'){
  $username = trim(string: $_POST['username'] ?? '');
  $password = trim(string: $_POST['password'] ?? '');

  if(empty($username) || empty($password)) {
    $error ="All fields are required.";
  }
  else {
    if($username ===$librarian_username && $password === $librarian_password) {
      $_SESSION['username'] = $username;
      $_SESSION['role'] = 'librarian';
      header(header: "Location: librarian_dashboard.php");
      exit;
    }

    $sql = "SELECT id password FROM students WHERE username = ?";
    $stmt = $conn->prepare(query: $sql);
    $stmt->bind_param(types: "s", var: $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows ==1){
      $stmt->bind_result(var: $id, vars: $hashed_password);
      $stmt->fetch();

      if(password_verify(password: $password, hash: $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'student';

        header(header: "Location: student_dashboard.php");
        exit;

      }
      else{
        $error ="Invalid password.";
      }
    }
      else{
        $error ="User not found.";
      }
      $stmt->close();

  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="register-box">
      <h2>Login</h2>
      <?php if ($error): ?>
        <p class="error"><?=htmlspecialchars(string: $error) ?> </p>
        <?php endif; ?>
        <form method="post" action="login.php">
          <label for="username">Username</label>
          <input id="username" name="username" type="text" required autofocus>

          <label for="password">Password</label>
          <input id="password" name="password" type="password" required>

          <button type="submit" class="button">Login</button>

        </form>
        <p style="margin-top: 15px; text-align:center;"> New user? <a href="registration.php" style="color: #4CAF50;">Register here.</a>
        </p>


    </div>

  </body>
</html>

