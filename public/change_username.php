<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["new_username"];    
    echo "Username updated successfully.";
}
?>

<form method="POST" action="change_username.php">
    <label for="new_username">New Username:</label>
    <input type="text" id="new_username" name="new_username" required>
    <button type="submit">Submit</button>
</form>