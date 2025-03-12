<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_email = $_POST["new_email"];
    echo "Email updated successfully.";
}
?>

<form method="POST" action="change_email.php">
    <label for="new_email">New Email:</label>
    <input type="email" id="new_email" name="new_email" required>
    <button type="submit">Submit</button>
</form>