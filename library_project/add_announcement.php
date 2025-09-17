<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();

}
$error ='';
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    if(!empty($message)) {
        $sql= "INSERT INTO announcements (message) VALUES ('$message')";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_dashboard.php");
            exit();
    }
    else {
        $error= "Error: ".$conn->error;
    }
}
else {
    $error= "Announcement cannot be empty!";
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Announcement</title>
        <link rel="stylesheet" href="admin.css">
        <link ref="stylesheet" href="add_announcements.css">
    </head>
    <body>
        <div class="navbar">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="add_book.php">Add Book</a>
            <a href="track_issued.php">Issued Books</a>

            <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
        </div>

        <div class="form-container">
            <h2>Post Announcement</h2>
            <?php if($error) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <textarea name="message" rows="5" placeholder="Write your announcement..." required></textarea><br>
                <button type="submit">Post</button>
            </form>
        </div>

    </body>
</html>
