<?php
session_start();
require_once('../app/db/config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit-username'])) {
        $newUsername = trim($_POST['new-username']);

        // Update username in the database
        $query = "UPDATE tb_user SET name = ? WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $newUsername, $username);

        if ($stmt->execute()) {
            $_SESSION['username'] = $newUsername; // Update session
            $_SESSION['message'] = "Username updated successfully!";
        } else {
            $_SESSION['message'] = "Error updating username. Please try again.";
        }

        header("Location: profile.php");
        exit();

    } elseif (isset($_POST['submit-email'])) {
        $newEmail = trim($_POST['new-email']);

        // Validate email format
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format.";
            header("Location: profile.php");
            exit();
        }

        // Update email in the database
        $query = "UPDATE tb_user SET email = ? WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $newEmail, $username);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Email updated successfully!";
        } else {
            $_SESSION['message'] = "Error updating email. Please try again.";
        }

        header("Location: profile.php");
        exit();

    } elseif (isset($_POST['submit-password'])) {
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];

        // Password validation 
        $passwordRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (!preg_match($passwordRegex, $newPassword)) {
            $_SESSION['message'] = "Password must contain at least:\n- One uppercase letter\n- One lowercase letter\n- One digit\n- One special character\n- Minimum 8 characters.";
            header("Location: profile.php");
            exit();
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['message'] = "Passwords do not match.";
            header("Location: profile.php");
            exit();
        }

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE tb_user SET password = ? WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashedPassword, $username);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Password changed successfully!";
        } else {
            $_SESSION['message'] = "Error updating password. Please try again.";
        }

        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid request.";
        header("Location: profile.php");
        exit();
    }
} else {
    header("Location: profile.php");
    exit();
}
?>