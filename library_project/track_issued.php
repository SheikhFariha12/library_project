<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();

}
$sql= "SELECT i.id, u.username, b.title, i.issue_date, i.return_date, i.status
From issued_books i
JOIN users u ON i.user_id = u.id
JOIN books b ON i.book_id = b.id
ORDER BY i.issue_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Track Issued Books</title>
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
            <h2>Issued and Returned Books</h2>
            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    if($result->num_rows>0) {
                        while($row= $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($row['username'])."</td>";
                            echo "<td>".htmlspecialchars($row['title'])."</td>";
                            echo "<td>".$row['issue_date']."</td>";
                            echo "<td>".($row['return_date'] ? $row['return_date']: "-")."</td>";
                            echo "<td>".ucfirst($row['status'])."</td>";
                            echo "</tr>";
                        }
                    }
                    else{
                        echo "<tr><td colspan='5'>No issued books found.</td></tr>";
                    }
                ?>
                </tbody>
            </table>

     </div>

    </body>
</html>

