<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if(isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $res_id = intval($_GET['id']);
    if($action == 'approve' || $action == 'decline') {
        $stmt = $conn->prepare("UPDATE reservations SET status=? WHERE id=?");
        $stmt->bind_param("si", $action, $res_id);
        $stmt->execute();
        $stmt->close();
    }
}

$sql = "SELECT r.id, u.username, b.title, r.status, r.created_at 
        FROM reservations r
        JOIN users u ON r.user_id = u.id
        JOIN books b ON r.book_id = b.id
        ORDER BY r.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Reservations</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="navbar">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="add_book.php">Add Book</a>
    <a href="add_announcement.php">Post Announcement</a>
    <a href="manage_reservations.php">Reservations</a>
    <a href="track_issued.php">Issued Books</a>

    <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
</div>

<div class="container">
    <h2>Manage Reservations</h2>
    <table class="reservation-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Book</th>
                <th>Status</th>
                <th>Requested On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['username'])."</td>";
                    echo "<td>".htmlspecialchars($row['title'])."</td>";
                    echo "<td>".ucfirst($row['status'])."</td>";
                    echo "<td>".$row['created_at']."</td>";
                    echo "<td>";
                    if($row['status'] == 'pending'){
                        echo "<a class='approve-btn' href='?action=approve&id=".$row['id']."'>Approve</a> ";
                        echo "<a class='decline-btn' href='?action=decline&id=".$row['id']."'>Decline</a>";
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No reservations found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
