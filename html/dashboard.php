<?php
session_start();

if(!isset($_SESSION['role'])) {
    header(header: "Location: login.php");
    exit();

}
if ($_SESSION['role'] == 'librarian') {
    header(header: "Location: librarian_dashboard.php");
    exit();
}

else{
    header(header: "Location: student_dashboard.php");
    exit();

}
?>
