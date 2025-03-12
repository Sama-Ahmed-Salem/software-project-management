
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
   
</head>
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  display: flex;
  background-color: #f0f1f7;
}

.sidebar {
  width: 80px;
  height: 100vh;
  background-color: #ffffff;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
  justify-content: space-between;
}

.logo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

.nav-list {
  list-style: none;
  width: 100%;
}

.nav-item {
  width: 100%;
  padding: 15px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  color: #a1a1a1;
  cursor: pointer;
  transition: background 0.3s;
}

.nav-item:hover {
  background-color: #f0f1f7;
  color: #3d5af1;
}

.nav-item a {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
  color: inherit; /* Inherits color from .nav-item */
}

.icon {
  width: 24px;
  height: 24px;
  margin-bottom: 5px;
}

.user-section {
  text-align: center;
  padding-bottom: 20px;
  cursor: pointer;
}

.user-section:hover {
  background-color: #f0f1f7;
  color: #3d5af1;
}

.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-bottom: 10px;
}

.user-name {
  font-size: 14px;
  color: #333;
}

    </style>
<body>
    <div class="sidebar">
        <ul class="nav-list">
            <div class="user-section">
                <a href="profile.php">
                <img src="images/profile picture.png" alt="User Avatar" class="user-avatar">
            </div>
            <div>
            <li class="nav-item active">   
                <a href="user.php">
                    <img src="images/dashboard.png" alt="Boards" class="icon">
                    <span>Boards</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="motivation.php">
                    <img src="images/motivation.png" alt="Upcoming" class="icon">
                    <span>Motivation</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="feedback.php">
                    <img src="images/feedback.png" alt="Feedback" class="icon">
                    <span>Feedback</span>
                </a>
            </li>
        </ul>
        <div class="logout-section">
            <li class="nav-item">
                <a href="../app/views/landing.php">
                    <img src="images/log-out.png" alt="Logout" class="icon">
                    <span>Logout</span>
                </a>
            </li>
        </div>
    </div>
</body>
</html>
