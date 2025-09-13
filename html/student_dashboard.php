<?php
session_start();
include 'db_connect.php';

$student_id = $_SESSION['user_id'];
$query = "SELECT b.title, br.borrow_date FROM borrow_records br JOIN books b ON br.book_id = b.id WHERE br.student_id = $student_id AND br.status = 'borrowed'";
$borrowed_books = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="top-bar">
      <span class="logo">Library</span>
      <form class="search-form" action="books.php" method="GET">
        <input type="text" name="query" placeholder="Search books..."required>
        <input type="submit" value="Serach">

      </form>
      <a href="reseravations.php">Reservations</a>
      <a href="borrow_return.php">Return</a>
      <a href="profile.php">Profile</a>
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="centered-title">Welcome Students!</div>
    <div class="content">
      <h2>Your Dashboard</h2>
      <p>Earn points by reviewing manga books, borrow your favourite titles and check the latest events!</p>

      <div class="quick-links">
        <a href="books.php" class="card">Browse Manga</a>
        <a href="review.php" class="card">Review/Rate</a>
        <a href="announcements.php" class="card">Announcements</a>
      </div>

    </div>
    

  </body>
</html>
    
