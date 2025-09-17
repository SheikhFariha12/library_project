<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();

}
$sql= "SELECT * FROM announcements ORDER BY created_at DESC";
$result= $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Announcements</title>
        <link rel="stylesheet" href="announcements.css">
    </head>
    <body>
        <div class="navbar">
            <a href="browse.php">Browse</a>
            <a href="announcements.php">Announcements</a>

            <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
        </div>

        <div class="container">
            <h2>Announcements</h2>
            <?php 
            if($result->num_rows > 0){
                while($ann=$result->fetch_assoc()) {
                    echo '<div class="announcement-card">';
                    echo '<p>'.htmlspecialchars($ann['message']).'</p>';
                    echo '<small>Posted on: '. $ann['created_at']. '</small';
                    echo '</div>';

                }
            }
            else{
                echo "<p>No announcements yet.</p>";
            }
            ?>
        </div>
                
    </body>
</html>

