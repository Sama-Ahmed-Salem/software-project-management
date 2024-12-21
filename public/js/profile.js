 // Profile form toggle scripts
 document.getElementById('changeUsernameBtn').addEventListener('click', function() {
  document.getElementById('changeUsernameForm').style.display = 'block';
  document.getElementById('changeEmailForm').style.display = 'none';
  document.getElementById('changePasswordForm').style.display = 'none';
});

document.getElementById('changeEmailBtn').addEventListener('click', function() {
  document.getElementById('changeEmailForm').style.display = 'block';
  document.getElementById('changeUsernameForm').style.display = 'none';
  document.getElementById('changePasswordForm').style.display = 'none';
});

document.getElementById('changePasswordBtn').addEventListener('click', function() {
  document.getElementById('changePasswordForm').style.display = 'block';
  document.getElementById('changeUsernameForm').style.display = 'none';
  document.getElementById('changeEmailForm').style.display = 'none';


});

function updateUsername() {
  const newUsername = document.getElementById('newUsername').value;
  const usernameRegex = /^[A-Za-z]+$/;
  if (newUsername === "") {
      alert("Please enter a new username.");
  } else if (usernameRegex.test(newUsername)) {
      document.getElementById('usernameDisplay').innerText = newUsername;
      document.getElementById('changeUsernameForm').style.display = 'none';
  } else {
      alert("Username must contain letters only.");
  }
}

function updatePassword() {
  const newPassword = document.getElementById('newPassword').value;
  const confirmNewPassword = document.getElementById('confirmNewPassword').value;
  const passwordRegex = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
  if (newPassword === "") {
      alert("Please enter a new password.");
  } else if (confirmNewPassword === "") {
      alert("Please confirm your new password.");
  } else if (newPassword !== confirmNewPassword) {
      alert("Passwords do not match. Please try again.");
  } else if (passwordRegex.test(newPassword)) {
      alert("Password updated successfully!");
      document.getElementById('changePasswordForm').style.display = 'none';
  } else {
      alert("Password must contain at least one uppercase letter, one special character, and be at least 8 characters long.");
  }
}

function updateEmail() {
  const newEmail = document.getElementById('newEmail').value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (newEmail === "") {
      alert("Please enter a new email.");
  } else if (emailRegex.test(newEmail)) {
      document.getElementById('emailDisplay').innerText = newEmail;
      document.getElementById('changeEmailForm').style.display = 'none';
  } else {
      alert("Please enter a valid email address.");
  }
}
