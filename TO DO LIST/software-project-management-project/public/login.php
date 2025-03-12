
<?php
require '../app/db/config.php'; 
require '../app/model/user_class.php'; 

$user = new User($conn);
// Handle sign-up
if (isset($_POST["submit"])) {
    $name =htmlspecialchars($_POST["signup-username"],ENT_QUOTES,'UTF-8') ;
    $email =htmlspecialchars($_POST["signup-email"],ENT_QUOTES,'UTF-8') ;
    $password =htmlspecialchars($_POST["signup-password"],ENT_QUOTES,'UTF-8') ;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $confirmPassword =htmlspecialchars($_POST["signup-confirm-password"],ENT_QUOTES,'UTF-8') ;

    $message =htmlspecialchars($user->signUp($name, $email, $password, $confirmPassword),ENT_QUOTES,'UTF-8') ;
    echo "<script>alert('$message');</script>";
}

// Handle sign-in
if (isset($_POST["submitt"])) {
  $username =htmlspecialchars($_POST["signin-username"],ENT_QUOTES,'UTF-8') ;
  $password =htmlentities($_POST["signin-password"],ENT_QUOTES,'UTF-8') ;
  $message =htmlspecialchars($user->signIn($username, $password),ENT_QUOTES,'UTF-8') ;

//   if ($message === "Login successful.") {
//       header("Location: user.php");
//       exit;
//   } else {
//       echo "<script>alert('$message');</script>";
//   }

if ($message === "Login successful.") {
	// Fetch the role of the user
	$sql = "SELECT role FROM tb_user WHERE name = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($role);
	$stmt->fetch();
	$stmt->close();

	// Redirect based on the role
	if ($role === 'admin') {
		// Redirect to admin page
		header("Location: admin.php");
	} else {
		// Redirect to user page
		header("Location: user.php");
	}
	exit; // Always call exit after a header redirect to stop further execution
} else {
	echo "<script>alert('$message');</script>";
}

} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../public/css/login.css">
 
</head>
<body>
<div id="container" class="container">
		<!-- FORM SECTION -->
		
			<!-- SIGN UP -->
   <form class="" action="" method="post" autocomplete="off" >

   <div class="row">
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<div class="form sign-up">
						<div class="input-group">
							<i for="signup-username" class='bx bxs-user'></i>
							<input type="text" name="signup-username" id="signup-username" placeholder="Username">
						</div>
						<div class="input-group">
							<i for="signup-email" class='bx bx-mail-send'></i>
							<input type="email" name="signup-email" id="signup-email" placeholder="Email">
						</div>
						<div class="input-group">
							<i for="signup-password" class='bx bxs-lock-alt'></i>
							<input type="password" name="signup-password" id="signup-password" placeholder="Password">
						</div>
						<div class="input-group">
							<i for="signup-confirm-password" class='bx bxs-lock-alt'></i>
							<input type="password" name="signup-confirm-password" id="signup-confirm-password" placeholder="Confirm password">
						</div>
            <!-- onclick="validateSignUp(event)" -->
						<button type="submit" name="submit">
							Sign up
						</button>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</div>
				  </div>
			  </div>
      </form>

			<!-- END SIGN UP -->


			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
						<div class="input-group">
							<i for="signin-username" class='bx bxs-user'></i>
							<input type="text" name="signin-username" id="signin-username" placeholder="Username">
						</div>
						<div class="input-group">
							<i for="signin-password" class='bx bxs-lock-alt'></i>
							<input type="password" name="signin-password" id="signin-password" placeholder="Password">
						</div>
            <!-- onclick="validateSignIn(event)" -->
						<button type="submit" name="submitt">
							Sign in
						</button>
						<!-- <p>
							<b>
								Forgot password? 
							</b>
						</p> -->
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</div>
				</div>
				<div class="form-wrapper">
				</div>
			</div>
			<!-- END SIGN IN -->

		</div>
		<!-- END FORM SECTION -->

		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>
				</div>
				<div class="img sign-in">
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>

  <script src="../public/js/login.js"></script>
</body>
</html>
=======
<?php
require '../app/db/config.php'; 
require '../app/model/user_class.php'; 

$user = new User($conn);
// Handle sign-up
if (isset($_POST["submit"])) {
    $name =htmlspecialchars($_POST["signup-username"],ENT_QUOTES,'UTF-8') ;
    $email =htmlspecialchars($_POST["signup-email"],ENT_QUOTES,'UTF-8') ;
    $password =htmlspecialchars($_POST["signup-password"],ENT_QUOTES,'UTF-8') ;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $confirmPassword =htmlspecialchars($_POST["signup-confirm-password"],ENT_QUOTES,'UTF-8') ;

    $message =htmlspecialchars($user->signUp($name, $email, $password, $confirmPassword),ENT_QUOTES,'UTF-8') ;
    echo "<script>alert('$message');</script>";
}

// Handle sign-in
if (isset($_POST["submitt"])) {
  $username =htmlspecialchars($_POST["signin-username"],ENT_QUOTES,'UTF-8') ;
  $password =htmlentities($_POST["signin-password"],ENT_QUOTES,'UTF-8') ;
  $message =htmlspecialchars($user->signIn($username, $password),ENT_QUOTES,'UTF-8') ;

  if ($message === "Login successful.") {
	$_SESSION['username'] = $username; // Set the username in the session
      header("Location: user.php");
      exit;
  } else {
      echo "<script>alert('$message');</script>";
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../public/css/login.css">
 
</head>
<body>
<div id="container" class="container">
		<!-- FORM SECTION -->
		
			<!-- SIGN UP -->
   <form class="" action="" method="post" autocomplete="off" >

   <div class="row">
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<div class="form sign-up">
						<div class="input-group">
							<i for="signup-username" class='bx bxs-user'></i>
							<input type="text" name="signup-username" id="signup-username" placeholder="Username">
						</div>
						<div class="input-group">
							<i for="signup-email" class='bx bx-mail-send'></i>
							<input type="email" name="signup-email" id="signup-email" placeholder="Email">
						</div>
						<div class="input-group">
							<i for="signup-password" class='bx bxs-lock-alt'></i>
							<input type="password" name="signup-password" id="signup-password" placeholder="Password">
						</div>
						<div class="input-group">
							<i for="signup-confirm-password" class='bx bxs-lock-alt'></i>
							<input type="password" name="signup-confirm-password" id="signup-confirm-password" placeholder="Confirm password">
						</div>
            <!-- onclick="validateSignUp(event)" -->
						<button type="submit" name="submit">
							Sign up
						</button>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</div>
				  </div>
			  </div>
      </form>

			<!-- END SIGN UP -->


			<!-- SIGN IN -->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
						<div class="input-group">
							<i for="signin-username" class='bx bxs-user'></i>
							<input type="text" name="signin-username" id="signin-username" placeholder="Username">
						</div>
						<div class="input-group">
							<i for="signin-password" class='bx bxs-lock-alt'></i>
							<input type="password" name="signin-password" id="signin-password" placeholder="Password">
						</div>
            <!-- onclick="validateSignIn(event)" -->
						<button type="submit" name="submitt">
							Sign in
						</button>
						<p>
							<b>
								Forgot password?
							</b>
						</p>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</div>
				</div>
				<div class="form-wrapper">
				</div>
			</div>
			<!-- END SIGN IN -->

		</div>
		<!-- END FORM SECTION -->

		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>
				</div>
				<div class="img sign-in">
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>

  <script src="../public/js/login.js"></script>
</body>
</html>