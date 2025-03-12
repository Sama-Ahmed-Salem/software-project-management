<?php
require_once("../controller/Controller.php");
class feedbackcontroller extends Controller{

    public function rating()
    {
      $username=$_REQUEST['username'];
      $feedback=$_REQUEST['feedback'];
      $this->model->submitFeedback($username,$feedback);
    }
}

?>