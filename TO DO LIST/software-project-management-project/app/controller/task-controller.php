<?php
require_once("../controller/Controller.php");
class taskcontroller extends Controller{
    
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