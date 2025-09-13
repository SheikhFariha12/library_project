<?php
session_start();
include 'db_connect.php';

$books = mysqli_query(mysql: $conn, query: "SELECT *FROM books");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Browse Books | Library</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="top-bar">
    <span class="logo">Books List</span>
    <form class="search-form" action="books.php" method="GET">
      <input type="text" name="query" placeholder="Search books or manga..." required>
      <input type="submit" value="Search">
    </form>
    <a href="dashboard.php">Dashboard</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
  <div class="books-container">
    <div class="book-card">
      <img src="cover_sample.jpg" alt="Book Cover">
      <h3>Attack on Titan</h3>
      <p>Author: Hajime Isayama</p>
      <a href="borrow_return.php?book_id=1" class="btn">Borrow</a>
    </div>
  </div>

  <div class="books-container">
  <div class="book-card">
    <img src="covers/attack_on_titan.jpg" alt="Attack on Titan" />
    <h3>Attack on Titan</h3>
      <p>Author: Hajime Isayama</p>
      <a href="borrow_return.php?book_id=1" class="btn">Borrow</a>
  </div>
  <div class="book-card">
    <img src="covers/naruto.jpg" alt="Naruto" />
    <h3>Naruto</h3>
      <p>Author: Hajime Isayama</p>
      <a href="borrow_return.php?book_id=1" class="btn">Borrow</a>
  </div>
  <div class="book-card">
    <img src="covers/death_note.jpg" alt="Death Note" />
    <h3>Death Note</h3>
      <p>Author: Hajime Isayama</p>
      <a href="borrow_return.php?book_id=1" class="btn">Borrow</a>
  </div>
  <div class="book-card">
    <img src="covers/one_piece.jpg" alt="One Piece" />
    <h3>One Piece</h3>
      <p>Author: Hajime Isayama</p>
      <a href="borrow_return.php?book_id=1" class="btn">Borrow</a>
  </div>
   </div>

</body>
</html>
