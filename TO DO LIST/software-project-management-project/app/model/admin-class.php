<?php
require_once(__DIR__ . '/model.php');
class Admin extends Model {

    protected  $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   
    public function retrieveUsersWithTasks() {
        $sql = "
            SELECT u.id, u.name, u.email, u.feedback, t.task_name, t.task_status
            FROM tb_user u
            LEFT JOIN tasks t ON u.id = t.user_id
        ";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $usersWithTasks = [];
            while ($row = $result->fetch_assoc()) {
                $usersWithTasks[] = $row;
            }
            return $usersWithTasks;
        } else {
            return [];
        }
    }

}
?>