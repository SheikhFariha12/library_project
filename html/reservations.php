<?php
session_start();
include 'db_connect.php';

$student_id = $_SESSION['user_id'] ?? 0;
if (!$student_id) {
    die("Please login first.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);


    $stmtCheck = $conn->prepare("SELECT available FROM books WHERE id = ?");
    $stmtCheck->bind_param("i", $book_id);
    $stmtCheck->execute();
    $stmtCheck->bind_result($available);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($available == 1) {
        
        $stmt = $conn->prepare("INSERT INTO borrow_records (student_id, book_id, borrow_date, status) VALUES (?, ?, CURDATE(), 'borrowed')");
        $stmt->bind_param("ii", $student_id, $book_id);
        if ($stmt->execute()) {
          
            $stmt2 = $conn->prepare("UPDATE books SET available = 0 WHERE id = ?");
            $stmt2->bind_param("i", $book_id);
            $stmt2->execute();
            $stmt2->close();
        }
        $stmt->close();
    } else {
        echo "<p style='color:red;'>This book is currently not available.</p>";
    }
}

$stmt3 = $conn->prepare("SELECT b.title, br.borrow_date FROM borrow_records br JOIN books b ON br.book_id = b.id WHERE br.student_id = ? AND br.status='borrowed'");
$stmt3->bind_param("i", $student_id);
$stmt3->execute();
$reservations = $stmt3->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Reservations</title>
</head>
<body>
    <h1>Your Reservations</h1>

    <?php if ($reservations && $reservations->num_rows > 0): ?>
    <ul>
        <?php while ($row = $reservations->fetch_assoc()): ?>
          <li><?= htmlspecialchars($row['title']) ?> (Borrowed on <?= htmlspecialchars($row['borrow_date']) ?>)</li>
        <?php endwhile; ?>
    </ul>
    <?php else: ?>
    <p>You have no current reservations.</p>
    <?php endif; ?>

    <h2>Borrow a Book</h2>
    <form method="POST" action="reservations.php">
        <label for="book_id">Book ID:</label>
        <input type="number" id="book_id" name="book_id" required min="1" />
        <button type="submit">Borrow Book</button>
    </form>
</body>
</html>
