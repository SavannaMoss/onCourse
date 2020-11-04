<?php

	include('config/db_connect.php');

	include('includes/session.php');

	// run query to get collection of majors
	$sql = "SELECT major FROM majors";

	$result = mysqli_query($conn, $sql);

	$majors = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	// rest of registration
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
  $major = $_POST['major'];

	$errors = array('username' => '', 'password' => '', 'name' => '', 'major' => '');

	if (isset($_POST['submit'])) {

		// check username
		if(empty($username)) {
			$errors['username'] = 'Username cannot be blank.';
		}

		// check password
		if(empty($password)) {
			$errors['password'] = 'Password cannot be blank.';
		} else if (strlen($password) < 6 || strlen($password) > 12){
      $errors['password'] = 'Password must be between 6 and 12 characters.';
    }

		// check name
		if(empty($name)) {
			$errors['name'] = 'Name cannot be blank.';
		}

		// check major
		if(empty($major)) {
			$errors['major'] = 'Must select a major.';
		}

		if (!array_filter($errors)) { // There are no errors

			// Check if the username already exists
			$sql = "SELECT * FROM users WHERE username = '$username'";

			// Run query
			if ($result = mysqli_query($conn, $sql)) {
        $valid = true;

        // Check that user exists
        if (mysqli_num_rows($result) > 0) {
            $valid = false;
        } else {

		      // Hash the Password
		      $password = password_hash($password, PASSWORD_DEFAULT);

					// Escape our data
					$username = mysqli_real_escape_string($conn, $username);
		      $password = mysqli_real_escape_string($conn, $password);
					$name = mysqli_real_escape_string($conn, $name);
          $major = mysqli_real_escape_string($conn, $major);

					// SQL
					$sql = "INSERT INTO users(username, password, name, major) VALUES('$username', '$password', '$name', '$major')";

					// Run query
					if (mysqli_query($conn, $sql)) {
						mysqli_close($conn);
						header("Location: login.php");
					} else {
						echo 'query error: '. mysqli_error($conn);
						die();
					}
				}
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Register</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container text-center">
  	   <h3>Register</h3>
       <p>Already have an account? <a href="login.php">Login here!</a></p>

			 <?php if(isset($valid) && !$valid) { ?>
	 	      <p class="text-danger">Username already exists.</p>
	 	  <?php } ?>

      <form method="POST">
        <!-- NAME -->
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
          <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
        </div>
        <!-- NAME -->
				<div class="text-danger">
					<p><?php echo $errors['name']; ?></p>
				</div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Name</span>
          </div>
          <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
        </div>
        <!-- MAJOR -->
				<div class="text-danger">
					<p><?php echo $errors['major']; ?></p>
				</div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text">Major</label>
          </div>
          <select name="major" class="custom-select" value="<?php echo htmlspecialchars($major); ?>">
            <option value="" selected>Choose...</option>
						<?php foreach($majors as $m ) { ?>
	            <option value="<?php echo $m['major']; ?>" <?php echo $major == $m['major'] ? "selected" : "" ?>><?php echo $m['major']; ?></option>
						<?php } ?>
          </select>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" name="submit" class="btn btn-primary">Register</button>
      </form>
    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
