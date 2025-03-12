<?php
require_once("../controller/Controller.php");
class UserController extends Controller{
public function Register()
{
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $password=$_REQUEST['password'];
  $confirmPassword=$_REQUEST['confirmPassword'];
  $this->model->signUp($name,$email,$password,$confirmPassword);
}

public function login()
{
  $username=$_REQUEST['username'];
  $password=$_REQUEST['password'];
  $this->model->signIn($username,$password);
}

public function rating()
{
  $username=$_REQUEST['username'];
  $feedback=$_REQUEST['feedback'];
  $this->model->submitFeedback($username,$feedback);
}

public function assignTask() //submittask
{
  $taskName=$_REQUEST['taskName'];
  $taskDate=$_REQUEST['taskDate'];
  $taskPriority=$_REQUEST['taskPriority'];
  $taskCategory=$_REQUEST['taskCategory'];
  $this->model->submitTask($taskName, $taskDate,$taskPriority, $taskCategory);
  
}

public function loadTask() //fetchtask
{
$this->model->fetchTasks();
}
public function removeTask() //deletetask
{
$this->model->deleteTask();
}
public function finishTask($taskId) //completetask
{
$taskId=$_REQUEST['taskId'];
$this->model->comleteTask($taskId);
}


}
?>