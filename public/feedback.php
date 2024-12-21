<?php
require '../app/db/config.php'; 
require '../app/model/user_class.php'; 
require '../app/model/feedback_class.php'; 

$user = new User($conn);
$feedbackk=new feedback($conn);

if (!isset($_SESSION['username'])) {
  echo "You must be logged in to submit feedback.";  // Send a user-friendly message if not logged in
  exit;
}

$username = $_SESSION['username'];  // Get the logged-in user's username

// Check if feedback is set in the POST data
if (isset($_POST['feedback'])) {
  $feedback = htmlspecialchars($_POST['feedback'], ENT_QUOTES, 'UTF-8');

  // Call the submitFeedback method, passing the logged-in user's username and feedback
  $message = $feedbackk->submitFeedback($username, $feedback);
  
  // Return the message or redirect to another page with a success message
  // echo $message;  // You could redirect after this, if needed, or display a success message
 // Send a message if feedback is empty or not set

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Page</title>
  <style>
    body {
      display: flex;
      background-color: #f0f1f7;
      margin: 0;
    }

    .feedback-container {
      margin: auto;
      padding: 20px;
      max-width: 500px;
      width: 100%;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #332902;
      text-transform: uppercase;
      letter-spacing: 3px;
    }

    .input_field {
      margin: 20px 0;
    }

    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #66dbff;
      resize: none;
      height: 100px;
    }

    .btn {
      text-align: center;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background: linear-gradient(135deg, #BFECFF, #CDC1FF, #FFF6E3, #FFCCEA);
      color: black;
      text-transform: uppercase;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #error_message {
      margin-bottom: 20px;
      background: linear-gradient(135deg, #BFECFF, #CDC1FF, #FFF6E3, #FFCCEA);
      padding: 10px;
      text-align: center;
      font-size: 14px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <!-- Include Dashboard -->
  <?php include '../app/views/dashboard.php'; ?>

  <!-- Feedback Form -->
  <div class="feedback-container">
    <h2>Feedback Form</h2>
    <div id="error_message"></div>
    <form method="POST" id="feedbackForm" action="">
      <div class="input_field">
        <textarea id="feedback"  name="feedback" placeholder="Your Feedback"></textarea>
      </div>
      <div class="btn">
        <input type="submit" value="Submit Feedback">
      </div>
    </form>
  </div>
  <script src="../public/js/feedback.js"></script>
 
</body>
</html>
