<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();

}

$username= $_SESSION['username'];
$userQuery = $conn->query("SELECT id FROM users WHERE username='$username' LIMIT 1");
$user= $userQuery->fetch_assoc();
$user_id= $user['id'];

$sql= "SELECT b.id, b.title,b.author, b.cover, i.issue_date
From issued_books i
JOIN books b ON i.book_id = b.id
WHERE i.user_id= $user_id
ORDER BY i.issue_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Issued Books</title>
        <link rel="stylesheet" href="browse.css">
    </head>
    <body>
        <div class="navbar">
            <a href="browse.php">Browse</a>
            <a href="announcements.php">Announcements</a>
            <a href="my_reservations.php">My reservations</a>
            <a href="issued_books_user.php">My Books</a>

            <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
        </div>

        <div class="container">
            <h2 class="issued-header">My Issued Books</h2>
            <div class="book-grid">
                <?php
                if($result && $result->num_rows > 0){
                while($book= $result->fetch_assoc()) {
                    $cover= !empty($book['cover']) ? $book['cover'] :'images/default.jpg';
                    echo '<div class="book-card">';
                    echo '<img src= "'.htmlspecialchars($cover).'" alt="'.htmlspecialchars($book['title']).'">';
                    echo '<h3>'.htmlspecialchars($book['title']).'</h3>';
                    echo '<p>by'.htmlspecialchars($book['author']).'</p>';
                    echo '<p><strong>Issued:</strong> '.htmlspecialchars($book['issue_date']).'</p>';
                    echo '<a href="return_book.php?id='.$book['id'].'" class="return-btn">Return</a>';
                    echo '</div>';
                    
                }
            }
            else{
                echo "<p>You have no issued books.</p>";
            }
            ?>
            </div>
        </div>
    </body>
</html>
