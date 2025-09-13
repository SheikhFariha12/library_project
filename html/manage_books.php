<!DOCTYPE html>
<html>
<head>
  <title>Manage Books | Library</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="top-bar">
    <span class="logo">Library</span>
    <a href="librarian_dashboard.php">Librarian Dashboard</a>
    <a href="announcements.php">Announcements</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
  <div class="manage-books-content">
    <h2>Manage Book Collection</h2>
    <form action="manage_books.php" method="POST">
      <input type="text" name="book_title" placeholder="Book Title" required>
      <input type="text" name="author" placeholder="Author" required>
      <input type="submit" name="add_book" value="Add Book">
    </form>
    <hr>
    <table>
      <tr>
        <th>Title</th><th>Author</th><th>Actions</th>
      </tr>
      <tr>
        <td>Attack on Titan</td>
        <td>Hajime Isayama</td>
        <td>
          <a href="#">Edit</a> | <a href="#">Delete</a>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
