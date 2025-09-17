<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();

}
$search='';
if(isset($_GET['search'])){
    $search= $_GET['search'];
    $sql= "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
    
}
else{
    $sql= "SELECT * FROM books";
}
$result= $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Browse Books</title>
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
            <form method="GET" class="search-bar">
                <input type="text" name="search" placeholder="Search books... " value="<?php echo htmlspecialchars($search); ?>" >
                <button type="submit">Search</button>
            </form>

            <div class="book-grid">
                <?php
                if($result->num_rows > 0){
                while($book= $result->fetch_assoc()) {
                    $cover= !empty($book['cover']) ? $book['cover'] :'images/default.jpg';
                    echo '<div class="book-card">';
                    echo '<img src= "'.htmlspecialchars($cover).'" alt="'.htmlspecialchars($book['title']).'">';
                    echo '<h3>'.htmlspecialchars($book['title']).'</h3>';
                    echo '<p>by'.htmlspecialchars($book['author']).'</p>';
                    echo '<a href="reserve_book.php?id='.$book['id'].'" class="reserve-btn">Reserve</a>';
                    echo '</div>';
                    
                }
            }
            else{
                echo "<p>No books found.</p>";
            }
            ?>
            </div>

        </div>

    </body>
</html>
