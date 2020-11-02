<?php

	include('config/db_connect.php');

	include('includes/session.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$errors = array('username' => '', 'password' => '');

	if (isset($_POST['submit'])) {

		// check username
		if(empty($username)) {
			$errors['username'] = 'Username cannot be blank';
		}

		// check password
		if(empty($password)) {
			$errors['password'] = 'Password cannot be blank';
		}

		if (!array_filter($errors)) { // There are no errors

			// Escape our data
			$username = mysqli_real_escape_string($conn, $username);

      // SQL
			$sql = "SELECT * FROM users WHERE username = '$username'";

			// Run query
			if ($result = mysqli_query($conn, $sql)) {
        // fetch the resulting rows as an array
      	$user = mysqli_fetch_assoc($result);

        $valid = false;
        // Check that user exists
        if (mysqli_num_rows($result) > 0) {
          if (password_verify($password, $user['password'])) {
            // Valid user, do Stuff
            $valid = true;
          }
        }

        // free the $result from memory (good practise)
      	mysqli_free_result($result);

      	// close connection
      	mysqli_close($conn);

        // Handle valid user or not
        if ($valid) {
					// Set session data
					$_SESSION['id'] = $user['id'];
					$_SESSION['username'] = $user['username'];
					$_SESSION['name'] = $user['name'];
					$_SESSION['major'] = $user['major'];
					$_SESSION['credits'] = $user['credits'];

          header("Location: index.php");
        }
			} else {
				echo 'query error: '. mysqli_error($conn);
				die();
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Login</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container text-center">
      <h3>Login Here</h3>
      <p>Don't have an account? <a href="register.php">Make one!</a></p>

      <?php if(isset($valid) && !$valid) { ?>
  	      <p class="text-danger">Invalid username/password combination.</p>
  	  <?php } ?>

      <form method="POST">

        <!-- USERNAME -->
				<div class="text-danger">
					<p><?php echo $errors['username']; ?></p>
				</div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Username</span>
          </div>
          <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
        </div>

        <!-- PASSWORD -->
				<div class="text-danger">
					<p><?php echo $errors['password']; ?></p>
				</div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Password</span>
          </div>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
      </form>
    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
