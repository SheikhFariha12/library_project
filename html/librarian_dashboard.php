<?php
session_start();
include 'db_connect.php';

$students_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM students"))['cnt'];
$books_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM books"))['cnt'];
$borrowed_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM borrow_records WHERE status = 'borrowed'"))['cnt'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Librarian Dashboard</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="top-bar">
      <span class="logo">Library</span>
      <form class="search-form" action="books.php" method="GET">
        <input type="text" name="query" placeholder="Search books..."required>
        <input type="submit" value="Serach">

      </form>
      <a href="manage_books.php">Reservations</a>
      <a href="reseravations.php">Reservations</a>
      <a href="borrow_return.php">Return</a>
      <a href="profile.php">Profile</a>
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="centered-title">Welcome Librarian!</div>
    <div class="content">
      <h2>Your Dashboard</h2>
      <p>Approve reservations, organize manga, and publish exciting announcements for students!</p>

      <div class="quick-links">
        <a href="manage_books.php" class="card">Book Manager</a>
        <a href="reports.php" class="card">Reports</a>
        <a href="announcements.php" class="card">Announcements</a>
      </div>

    </div>
    <p>Total students: <?= $students_count?></p>
    <p>Total Books: <?= $books_count ?></p>
    <p>Borrowed Books: <?= $borrowed_count ?></p>
    

  </body>
</html>


