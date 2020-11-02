<!-- NEED TO FIX -->

<?php

	include('config/db_connect.php');

	include('includes/session.php');

	// Check for profile to display
	if (isset($_SESSION['id'])) {
		// run query to get collection of majors
		$sql = "SELECT major FROM majors";

		$result = mysqli_query($conn, $sql);

		$majors = mysqli_fetch_all($result, MYSQLI_ASSOC);

		mysqli_free_result($result);

		// run query to get user
		$id = mysqli_real_escape_string($conn, $_SESSION['id']);

		$sql = "SELECT * FROM users WHERE id = $id";

		$result = mysqli_query($conn, $sql);

		$user = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

		mysqli_close($conn);

    $name = $user['name'];
    $major = $user['major'];
	}
  else {
    $name = $_POST['name'];
  	$major = $_POST['major'];
  }

  if (isset($_POST['submit'])) {

		// check name
		if(empty($name)) {
			$errors['name'] = 'Name cannot be blank.';
		}

		// check major
		if(empty($major)) {
			$errors['major'] = 'Must select a major.';
		}

		if (!array_filter($errors)) { // There are no errors

			// Run query
			if ($result = mysqli_query($conn, $sql)) {
        $valid = true;

        // Check that user exists
        if (mysqli_num_rows($result) > 0) {
            $valid = false;
        } else {

					// Escape our data
					$name = mysqli_real_escape_string($conn, $name);
          $major = mysqli_real_escape_string($conn, $major);

					// SQL
					$sql = "UPDATE users SET name = '$name', major = '$major' WHERE id = $id";

					// Run query
					if (mysqli_query($conn, $sql)) {
						header("Location: profile.php");
					}  else {
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
    <title>onCourse | Edit Profile</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container text-center">
  	   <h3>Edit Profile</h3>
      <form>
        <!-- NAME -->
        <div class="text-danger">
					<p><?php echo $errors['name']; ?></p>
				</div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Name</span>
          </div>
          <input type="text" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
        </div>

        <!-- MAJOR -->
				<div class="text-danger">
					<p><?php echo $errors['major']; ?></p>
				</div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Major</label>
          </div>
          <select name="major" class="custom-select" value="<?php echo htmlspecialchars($major); ?>">
            <option value="" selected>Choose...</option>
						<?php foreach($majors as $m ) { ?>
	            <option value="<?php echo $m['major']; ?>" <?php echo $major == $m['major'] ? "selected" : "" ?>><?php echo $m['major']; ?></option>
						<?php } ?>
          </select>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
