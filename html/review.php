<!-- review.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Book Reviews | Library</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="top-bar">
    <span class="logo">Library</span>
    <a href="dashboard.php">Dashboard</a>
    <a href="books.php">Books</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
  <div class="review-content">
    <h2>Rate & Review Books</h2>
    <form action="review.php" method="POST">
      <label>Book:</label>
      <input type="text" name="book" placeholder="Type book name" required>
      <label>Rating:</label>
      <select name="rating">
        <option>5</option><option>4</option><option>3</option><option>2</option><option>1</option>
      </select>
      <label>Your Review:</label>
      <textarea name="review" required></textarea>
      <input type="submit" value="Submit Review">
    </form>
    
    <div class="reviews-list">
      <div class="review">
        <strong>Attack on Titan</strong> - 5⭐ <br>
        Epic manga, loved every volume! <em>- Naruto</em>
      </div>
      
    </div>
  </div>
</body>
</html>
