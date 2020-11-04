<?php

	include('config/db_connect.php');

	include('includes/session.php');

	// Check for course to display
	if (isset($_SESSION['id']) && isset($_GET['code'])) {
		$id = mysqli_real_escape_string($conn, $_SESSION['id']);
		$code = mysqli_real_escape_string($conn, $_GET['code']);

		// GET COURSE
		$sql = "SELECT * FROM courses WHERE code = '$code'";

		$result = mysqli_query($conn, $sql);

		$course = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

    // CHECK IF IN USER_COURSES
		$sql = "SELECT * FROM user_courses WHERE userid = $id AND coursecode = '$code'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$course_details = mysqli_fetch_assoc($result);
		}	else {
			$course_details['taken'] = 0;
		}

		mysqli_free_result($result);

		// ADD / REMOVE FUNCTIONALITY

		// SUBMIT - ADD
		if (isset($_POST['submitAdd'])) {
			// run query to get user
			$sql = "SELECT * FROM users WHERE id = $id";

			$result = mysqli_query($conn, $sql);

			$user = mysqli_fetch_assoc($result);

			mysqli_free_result($result);

			// UPDATE CREDITS
			$newcredits = $user['credits'] + $course['hours'];

			$sql = "UPDATE users SET credits = $newcredits WHERE id = $id";

			mysqli_query($conn, $sql);

			// INSERT COURSE
			$sql = "INSERT INTO user_courses(userid, coursecode, current, taken) VALUES($id, '$code', 1, 1)";

			mysqli_query($conn, $sql);

			mysqli_close($conn);

			header("Location: library.php?id=".$_SESSION['id']);
		}

		// SUBMIT - REMOVE
		if (isset($_POST['submitRemove'])) {
			// run query to get user
			$sql = "SELECT * FROM users WHERE id = $id";

			$result = mysqli_query($conn, $sql);

			$user = mysqli_fetch_assoc($result);

			mysqli_free_result($result);

			// UPDATE CREDITS
			$newcredits = $user['credits'] - $course['hours'];

			$sql = "UPDATE users SET credits = $newcredits WHERE id = $id";

			mysqli_query($conn, $sql);

			// REMOVE COURSE
			$sql = "DELETE FROM user_courses WHERE userid = $id AND coursecode = '$code'";

			mysqli_query($conn, $sql);

			mysqli_close($conn);

			header("Location: library.php?id=".$_SESSION['id']);
		}
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Course</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container text-center">
      <h3><?php	echo htmlspecialchars($course['code']) . " " . htmlspecialchars($course['name']); ?></h3>

      <p><span class="detail">Instructor: </span><?php echo htmlspecialchars($course['instructor']); ?></p>
      <p><span class="detail">Credits: </span><?php echo htmlspecialchars($course['hours']); ?></p>
      <p><span class="detail">GenEd: </span><?php echo htmlspecialchars($course['gened']); ?></p>
      <p><span class="detail">Description: </span><?php echo htmlspecialchars($course['description']); ?></p>

			<!-- ADD OR REMOVE FROM LIBRARY -->
			<?php if ($course_details['taken'] == 0) { ?>
				<form method="POST">
					<button class="btn btn-primary" type="submit" name="submitAdd">Add to Library</button>
				</form>
			<?php } else { ?>
				<form method="POST">
					<button class="btn btn-primary" type="submit" name="submitRemove">Remove from Library</button>
				</form>
			<?php } ?>
  	</div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
