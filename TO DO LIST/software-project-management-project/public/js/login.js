let container = document.getElementById('container');

toggle = () => {
  container.classList.toggle('sign-in');
  container.classList.toggle('sign-up');
};

setTimeout(() => {
  container.classList.add('sign-in');
}, 200);

// Sign-up validation
function validateSignUp(event) {
  event.preventDefault();

  const username = document.getElementById('signup-username').value;
  const email = document.getElementById('signup-email').value;
  const password = document.getElementById('signup-password').value;
  const confirmPassword = document.getElementById('signup-confirm-password').value;

  // Check if fields are empty
  if (!username || !email || !password || !confirmPassword) {
    alert('All fields must be filled!');
    return;
  }

  // Email validation
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailPattern.test(email)) {
    alert('Please enter a valid email address.');
    return;
  }

  // Password match validation
  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    return;
  }

  // Password length validation
  if (password.length < 6) {
    alert('Password must be at least 6 characters.');
    return;
  }

  // If validation passes, proceed with sign up (can add API call or further actions here)
  alert('Sign-up successful!');
}

// Sign-in validation
function validateSignIn(event) {
  event.preventDefault();

  const username = document.getElementById('signin-username').value;
  const password = document.getElementById('signin-password').value;

  // Check if fields are empty
  if (!username || !password) {
    alert('Both fields must be filled!');
    return;
  }

  // If validation passes, proceed with sign in (can add API call or further actions here)
  alert('Sign-in successful!');
}