<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();

}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
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
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3>Add Book</h3>
                    <p>Add new books to the library database.</p>
                    <a href="add_book.php">Go</a>
                </div>

                <div class="dashboard-card">
                    <h3>Post Announcement</h3>
                    <p>Share announcements with students.</p>
                    <a href="add_announcement.php">Go</a>
                </div>

                <div class="dashboard-card">
                    <h3>Manage Reservations</h3>
                    <p>Approve or decline student reservations.</p>
                    <a href="manage_reservations.php">Go</a>
                </div>

                <div class="dashboard-card">
                    <h3>Track Issued Books</h3>
                    <p>Monitor issued and returned books.</p>
                    <a href="track_issued.php.php">Go</a>
                </div>

                <div class="dashboard-card">
                    <h3>Late Fees</h3>
                    <p>Manage and track late fees of students.</p>
                    <a href="late_fees.php">Go</a>
                </div>

            </div>
        </div>

    </body>
</html>
