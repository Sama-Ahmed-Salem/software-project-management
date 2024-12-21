<?php
require_once('../app/db/config.php');

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the current username from session
$username = $_SESSION['username'];

// Fetch user details from the database
$query = "SELECT name, email FROM tb_user WHERE name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$name = $user['name'];
$email = $user['email'];

// Get message from session if available
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']); // Clear message after displaying it
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../public/css/profile.css">
    
</head>
<body>
<?php include '../app/views/dashboard.php'; ?>

    <div class="profile-container">
        <!-- success message -->
        <?php if ($message): ?> 
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Profile Image-->
        <div class="profile-icon">
            <img src="../public/images/profile picture.png" alt="Profile Image">
        </div>
        <h2 id="usernameDisplay"><?php echo $name; ?></h2>
        <p>Email: <span id="emailDisplay"><?php echo $email; ?></span></p>

        <div class="buttons">
            <button id="changeUsernameBtn" class="btn">Change Username</button>
            <button id="changeEmailBtn" class="btn">Change Email</button>
            <button id="changePasswordBtn" class="btn">Change Password</button>
        </div>

        <div id="username-form" class="change-form" style="display: none;">
            <form action="update_profile.php" method="POST">
                <label for="new-username">New Username:</label>
                <input type="text" id="new-username" name="new-username" required>
                <button type="submit" name="submit-username">Update Username</button>
                <button type="button" onclick="hideForm('username')">Cancel</button>
            </form>
        </div>

        <div id="email-form" class="change-form" style="display: none;">
    <form action="update_profile.php" method="POST" onsubmit="return validateEmail()">
        <label for="new-email">New Email:</label>
        <input type="email" id="new-email" name="new-email" required>
        <button type="submit" name="submit-email">Update Email</button>
        <button type="button" onclick="hideForm('email')">Cancel</button>
    </form>
</div>


        <div id="password-form" class="change-form" style="display: none;">
            <form id="passwordForm" action="update_profile.php" method="POST" onsubmit="return validatePassword()">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <button type="submit" name="submit-password">Update Password</button>
                <button type="button" onclick="hideForm('password')">Cancel</button>
            </form>
        </div>
    </div>

    <script src="../public/js/profile.js"></script>
    <script>
        //replace the updated values without reloading the page
        document.getElementById('changeUsernameBtn').addEventListener('click', function() {
            showForm('username');
        });

        document.getElementById('changeEmailBtn').addEventListener('click', function() {
            showForm('email');
        });

        document.getElementById('changePasswordBtn').addEventListener('click', function() {
            showForm('password');
        });

        function showForm(formType) {
            // Hide all forms first
            document.getElementById('username-form').style.display = 'none';
            document.getElementById('email-form').style.display = 'none';
            document.getElementById('password-form').style.display = 'none';
            
            // Show the selected form
            document.getElementById(formType + '-form').style.display = 'block';
        }

        // Hide the form
        function hideForm(formType) {
            document.getElementById(formType + '-form').style.display = 'none';
        }
    </script>
</body>
</html>