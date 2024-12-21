<?php
require '../app/db/config.php'; 
require '../app/model/admin-class.php'; 

$admin = new Admin($conn);

if (!isset($_SESSION['username'])) {
    echo "You must be logged in to access the admin panel.";
    exit;
}

$username = $_SESSION['username'];  

$sql = "SELECT role FROM tb_user WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();

if ($role !== 'admin') {
    echo "You do not have the necessary permissions to access this page.";
    exit;
}

$users = $admin->retrieveUsersWithTasks();  // Fetch the users and tasks
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/admin.css">
</head>
<body>
    <div class="container">
        <h1 class="welcome-header">Welcome Admin</h1>
        <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by Username..." onkeyup="filterTable()">

</div>

        <table id="adminTable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Task</th>
                    <th>Task Status</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user) {
                echo "<tr>
                    <td>" . htmlspecialchars($user['name']) . "</td>
                    <td>" . htmlspecialchars($user['email']) . "</td>
                    <td>" . htmlspecialchars($user['task_name'] ?? '--') . "</td> <!-- Display task if available -->
                    <td>" . htmlspecialchars($user['task_status'] ?? '--') . "</td> <!-- Display task status if available -->
                    <td>" . htmlspecialchars($user['feedback']) . "</td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <button class="logout-button" onclick="window.location.href='../app/views/landing.php'">Log Out</button>
    </div>
    <script src="../public/js/admin.js"></script>
</body>
</html>
