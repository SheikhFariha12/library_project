<!DOCTYPE html>
<html>
<head>
  <title>Profile | Library</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="top-bar">
    <span class="logo">Library</span>
    <a href="dashboard.php">Dashboard</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
  <div class="profile-content">
    <h2>My Profile</h2>
    <form action="profile.php" method="POST">
      <label>Name:</label> <input type="text" name="name" value="Naruto Uzumaki">
      <label>Username:</label> <input type="text" name="username" value="naruto" readonly>
      <label>Password:</label> <input type="password" name="password" placeholder="Change password">
      <input type="submit" name="update" value="Update Info">
      <input type="submit" name="delete" value="Delete Account" onclick="return confirm('Sure?');">
    </form>
  </div>
</body>
</html>
