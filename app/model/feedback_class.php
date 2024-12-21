<?php

require_once(__DIR__ . '/model.php');
class feedback extends model{

    public function __construct($db_connection) {
        $this->conn = $db_connection;
        $this->username = $_SESSION['username'] ?? null;
    }
    
    public function submitFeedback($username, $feedback) {
        if (empty($feedback)) {
            return "Feedback cannot be empty.";
        }

        // Insert or update feedback into the database for the specific user
        $query = "UPDATE tb_user SET feedback = ? WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $feedback, $username);

        if ($stmt->execute()) {
            return "Feedback submitted successfully.";
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}

?>