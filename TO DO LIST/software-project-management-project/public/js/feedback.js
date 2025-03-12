function validate() {
  var yourfeedback = document.getElementById("feedback").value; // Getting the value of the feedback textarea
  var error_message = document.getElementById("error_message");

  error_message.style.padding = "10px";

  var text;
  if (yourfeedback.trim().length === 0) { // Checking if the feedback length is more than 140 characters
    text = "Cannot Submit without your feedback!";
    error_message.innerHTML = text;
    return false; // Prevent form submission
  }
  
  alert("Form Submitted Successfully!");
  return true; // Allow form submission
}

// Attach validate function to form submit event
document.getElementById("feedbackForm").onsubmit = function(event) {
  if (!validate()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
};
