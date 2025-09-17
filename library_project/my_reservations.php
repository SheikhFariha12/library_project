<?php
session_start();
include 'db.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'student'){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

$reservations = $conn->query("
    SELECT r.id, b.title, r.status, r.created_at
    FROM reservations r
    JOIN books b ON r.book_id = b.id
    WHERE r.user_id=$user_id
    ORDER BY r.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Reservations</title>
   <link rel="stylesheet" href="browse.css">         
<link rel="stylesheet" href="reservation.css">    
<link rel="stylesheet" href="admin.css">          
<link rel="stylesheet" href="login.css">          

</head>
<body>
<div class="navbar">
    <a href="browse.php">Browse</a>
    <a href="javascript:void(0);" class="announcement-btn">Announcements</a>
    <a href="my_reservations.php">My Reservations</a>
    <a href="issued_books_user.php">My Books</a>
    <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
</div>

<div class="container">
    <h2>My Reservations</h2>
    <?php
    if(isset($_SESSION['message'])){
        echo "<p style='color:green;'>".$_SESSION['message']."</p>";
        unset($_SESSION['message']);
    }
    ?>
    <table class="reservation-table">
        <thead>
            <tr>
                <th>Book</th>
                <th>Status</th>
                <th>Reserved On</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($reservations->num_rows > 0){
                while($row = $reservations->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['title'])."</td>";
                    echo "<td>".ucfirst($row['status'])."</td>";
                    echo "<td>".$row['created_at']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No reservations found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
