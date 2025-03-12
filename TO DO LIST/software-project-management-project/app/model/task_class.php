<?php

require_once(__DIR__ . '/model.php');
class Task extends model{
    private $message;
    private $username;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
        $this->username = $_SESSION['username'] ?? null;
    }

    // Handle task submission
    public function submitTask($taskName, $taskDate, $taskPriority, $taskCategory) {
        if (empty($taskName)) {
            return "Task name cannot be empty!";
        }

        // Fetch user_id based on username
        $stmt = $this->conn->prepare("SELECT id FROM tb_user WHERE name = ?");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $userId = $user['id'];

        // Insert task into the database
        $stmt = $this->conn->prepare("INSERT INTO tasks (user_id, task_name, task_date, task_priority, task_category, task_status) VALUES (?, ?, ?, ?, ?, 'Incomplete')");
        $stmt->bind_param("issss", $userId, $taskName, $taskDate, $taskPriority, $taskCategory);

        if ($stmt->execute()) {
            return "Task added successfully!";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // Fetch tasks for the logged-in user
    public function fetchTasks() {
        $stmt = $this->conn->prepare("SELECT id, task_name, task_date, task_priority, task_category, task_status FROM tasks WHERE user_id = (SELECT id FROM tb_user WHERE name = ?)");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Delete a task
    public function deleteTask($taskId) {
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = (SELECT id FROM tb_user WHERE name = ?)");
        $stmt->bind_param("is", $taskId, $this->username);
        if ($stmt->execute()) {
            return "Task deleted successfully.";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // Mark a task as complete
    public function completeTask($taskId) {
        $stmt = $this->conn->prepare("UPDATE tasks SET task_status = 'Complete' WHERE id = ? AND user_id = (SELECT id FROM tb_user WHERE name = ?)");
        $stmt->bind_param("is", $taskId, $this->username);
        if ($stmt->execute()) {
            return "Task marked as complete.";
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}
?>
