<?php
session_start();
include 'db.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'student'){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $book_id = intval($_GET['id']);
    $user_id = $_SESSION['id'];
    $check = $conn->query("SELECT * FROM reservations WHERE user_id=$user_id AND book_id=$book_id AND status='pending'");
    if($check->num_rows == 0){
        $conn->query("INSERT INTO reservations (user_id, book_id, status, created_at) VALUES ($user_id, $book_id, 'pending', NOW())");
        $_SESSION['message'] = "Book reserved successfully!";
    } else {
        $_SESSION['message'] = "You already reserved this book!";
    }
}

header("Location: my_reservations.php");
exit();
?>
