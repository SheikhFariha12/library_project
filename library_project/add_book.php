<?php
session_start();
include 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();

}
$error= '';
$success='';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);

    $cover= 'images/default.jpg';
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] ==0){
        $filename = basename($_FILES['cover']['name']);
        $target_dir= "images/";
        $target_file= $target_dir . $filename;
        if(move_uploaded_file($_FILES['cover']['tmp_name'], $target_file)) {
            $cover= $target_file;
        }
        else{
            $error= "Failed to upload cover image!";
        }
    }
    if(!$error) {
        $stmt = $conn->prepare("INSERT INTO books (title, author, cover) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $author, $cover);
        if($stmt->execute()) {
            $success= "Book added successfully!";
        }
        else{
            $error= "Database error: ".$conn->error;
        }
        $stmt->close();

        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Book</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div class="navbar">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="add_book.php">Add Book</a>
            <a href="add_announcement.php">Post Announcement</a>

            <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
        </div>

        <div class="form-container">
            <h2>Add New Book</h2>
            <?php if($error) echo "<p class='error'>$error</p>"; ?>
            <?php if($success) echo "<p class='success'>$success</p>"; ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Book Title" required><br>
                <input type="text" name="author" placeholder="Author" required><br>
                <input type="file" name="cover" accept="image/*"><br>
                <button type="submit">Add Book</button>
            </form>
        </div>

    </body>
</html>

