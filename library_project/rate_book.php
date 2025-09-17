<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();

}
if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);
    $rating = intval($_POST['rating']);
    $comment = $conn->real_escape_string($_POST['comment']);
    $user_id = $_SESSION['id'];

    $conn->query("INSERT INTO ratings (user_id, book_id, rating, comment) VALUES ($user_id, $book_id, $rating, '$comment')");
    $_SESSION['message'] = "Thank you for your rating.";
    header("Location: issued_books_user.php");
    exit();

}
?>

