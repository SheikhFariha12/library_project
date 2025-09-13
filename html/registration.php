<?php
session_start();
include 'db_connect.php';

$error = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] ==='POST'){
  $username = trim(string: $_POST['username'] ?? '');
  $password = trim(string: $_POST['password'] ?? '');

  if(empty($username) || empty($password)) {
    $error ="All fields are required.";
  }

  else {
    $sql_check = "SELECT id, password FROM students WHERE username = ?";
    $stmt_check = $conn->prepare(query: $sql_check);
    $stmt_check->bind_param(types: "s", var: $username);
    $stmt_check->execute();
    $stmt_check->store_result();
    
    }

    if($stmt_check->num_rows >0){
      $error = "Username already taken.";
      $stmt_check->close();

   } 
   else{
    $stmt_check->close();
    $hashed_password= password_hash(password: $password, algo: PASSWORD_DEFAULT);
    $sql_insert= "INSERT INTO students (username,password) VALUES (?,?)";
    $stmt_insert= $conn->prepare(query: $sql_insert);
    $stmt_insert->bind_param(types:"ss", var: $username, vars: $hashed_password);

    if($stmt_insert->execute()) {
      $success = "Registration successful! You can login now.";
    }

    else{
      $error = "Error. Please try again.";
    }

    $stmt_insert->close();
  
    
   }

}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="register-box">
      <h2>Register</h2>
      <?php if ($error): ?>
        <p class="error"><?=htmlspecialchars(string: $error) ?> </p>
        <?php elseif ($success): ?>
        <p class="success"><?=htmlspecialchars(string: $success) ?> </p>
        <?php endif; ?>
        <form method="post" action="registration.php" autocomplete="off">
          
          <label for="username">Username</label>
          <input id="username" name="username" type="text" required>

          <label for="password">Password</label>
          <input id="password" name="password" type="password" required>

          <button type="submit" class="button">Register</button>

        </form>
        <p> Already have an account? <a href="login.php" style="color: #4CAF50;">Login here.</a>
        </p>

    </div>

  </body>
</html>


