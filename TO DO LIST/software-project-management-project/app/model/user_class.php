<?php
require_once(__DIR__ . '/model.php');
class User extends Model {

    private $username;
    private $message;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
        $this->username = $_SESSION['username'] ?? null;
    }

    // Sign up 
     function signUp($name, $email, $password, $confirmPassword) {
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            return "All fields are required.";
        }

        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        // Check for duplicate email
        $query = "SELECT * FROM tb_user WHERE email = ? AND password=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email,$password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Email is already taken.";
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database with hashed password
        $query = "INSERT INTO tb_user (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            return "Signup successful.";
        } else {
            return "Error occurred during signup.";
        }
    }

    // Sign in 
     function signIn($username, $password) {
        if (empty($username) || empty($password)) {
            return "Both fields are required.";
        }

        $query = "SELECT * FROM tb_user WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password using password_verify()
            if ( $user['password']) {
                session_start();
                $_SESSION["username"] = $user['name'];
                return "Login successful.";
            } else {
                return "Invalid password.";
            }
        } else {
            return "Invalid username.";
        }
    } 

    public function submitFeedback($username, $feedback) {
        if (empty($feedback)) {
           
        }

        // Insert or update feedback into the database for the specific user
        $query = "UPDATE tb_user SET feedback = ? WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $feedback, $username);

        if ($stmt->execute()) {
           
        } else {
            
        }
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
            $this->message = "Task added successfully!";
        } else {
            $this->message = "Error: " . $this->conn->error;
        }
    }

    // Get message
    public function getMessage() {
        return $this->message;
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
