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

		// SEMESTERS
		$sql = "SELECT semester FROM semesters ORDER BY RIGHT(semester, 4), semester DESC";

		$result = mysqli_query($conn, $sql);

		$semesters = mysqli_fetch_all($result, MYSQLI_ASSOC);

		mysqli_free_result($result);

		// GENEDS
		$sql = "SELECT * FROM geneds";

		$result = mysqli_query($conn, $sql);

		$geneds = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
			$firstg = explode(", ", $course['geneds'])[0];
			$sql = "INSERT INTO user_courses(userid, coursecode, current, taken, gened) VALUES($id, '$code', 1, 1, '$firstg')";

			mysqli_query($conn, $sql);

			// UPDATE GENED CREDITS
			if ($firstg != 'N/A') {
				$newgencredits = $user['gened_credits'] + $course['hours'];

				$sql = "UPDATE users SET gened_credits = $newgencredits WHERE id = $id";

				mysqli_query($conn, $sql);
			}

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

			// UPDATE GENED CREDITS
			if ($user['gened_credits'] != 'N/A') {
				$newgencredits = $user['gened_credits'] - $course['hours'];

				$sql = "UPDATE users SET gened_credits = $newgencredits WHERE id = $id";

				mysqli_query($conn, $sql);
			}

			// REMOVE COURSE
			$sql = "DELETE FROM user_courses WHERE userid = $id AND coursecode = '$code'";

			mysqli_query($conn, $sql);

			mysqli_close($conn);

			header("Location: library.php?id=".$_SESSION['id']);
		}

		// UPDATE FUNCTIONALITY

		// UPDATE SEMESTER TAKEN
		if (isset($_POST['updateS'])) {

			// UPDATE SEMESTER
			$newsemester = $_POST['semester'];
			$currentsem = "Fall 2020";

			$sql = "UPDATE user_courses SET semester = '$newsemester' WHERE userid = $id AND coursecode = '$code'";

			mysqli_query($conn, $sql);

			// UPDATE CURRENT
			$newsemester == $currentsem ? $c = 1 : $c = 0;

			$sql = "UPDATE user_courses SET current = ". $c ." WHERE userid = $id AND coursecode = '$code'";

			mysqli_query($conn, $sql);

			mysqli_close($conn);

			header("Location: library.php?id=".$_SESSION['id']);
		}

		// UPDATE SELECTED GENED
		if (isset($_POST['updateG'])) {

			// UPDATE SELECTED GENED
			$newgened = explode(" ", $_POST['gened'])[0];

			$sql = "UPDATE user_courses SET gened = '$newgened' WHERE userid = $id AND coursecode = '$code'";

			mysqli_query($conn, $sql);

			mysqli_close($conn);

			header("Location: credits.php?id=".$_SESSION['id']);
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

    <div class="container text-center" role="main">
      <h1><?php	echo htmlspecialchars($course['code']) . " " . htmlspecialchars($course['name']); ?></h1>

      <p><span class="detail">Instructor: </span><?php echo htmlspecialchars($course['instructor']); ?></p>
      <p><span class="detail">Credits: </span><?php echo htmlspecialchars($course['hours']); ?></p>
      <p><span class="detail">GenEds: </span><?php echo htmlspecialchars($course['geneds']); ?></p>
      <p><span class="detail">Description: </span><?php echo htmlspecialchars($course['description']); ?></p>

			<!-- ADD OR REMOVE FROM LIBRARY -->
			<?php if ($course_details['taken'] == 0) { ?>
				<form method="POST">
					<button class="btn btn-primary" type="submit" name="submitAdd">Add to Library</button>
				</form>
			<?php } else { ?>
				<form method="POST">

					<!-- UPDATE SEMESTER TAKEN -->
					<div class="input-group">
						<div class="input-group-prepend">
						  <span class="detail mr-2">Semester Taken: </span>
						</div>

						<select name="semester" class="custom-select" value="<?php echo htmlspecialchars($semester); ?>" required aria-required="true" aria-label="Semester Taken">
							<option value="" selected>Choose...</option>
							<?php foreach($semesters as $s ) { ?>
								<option value="<?php echo $s['semester']; ?>" <?php echo $course_details['semester'] == $s['semester'] ? "selected" : "" ?>>
									<?php echo $s['semester']; ?>
								</option>
							<?php } ?>
						</select>

						<div class="input-group-append">
						  <button class="btn btn-primary" type="submit" name="updateS">Update</button>
						</div>
					</div>

					<!-- UPDATE CHOSEN GENED -->
					<?php if (!(stristr($course['geneds'], 'N/A'))) { ?>
						<div class="input-group mt-3">
							<div class="input-group-prepend">
							  <span class="detail mr-2">Selected GenEd: </span>
							</div>

							<select name="gened" class="custom-select" value="<?php echo htmlspecialchars($gened); ?>" required aria-required="true" aria-label="Selected GenEd">
								<option value="" selected>Choose...</option>
								<?php foreach($geneds as $g ) {
									if (stristr($course['geneds'], $g['abbr'])) { ?>
										<option value="<?php echo $g['abbr'] . ' - ' . $g['name']; ?>" <?php echo $course_details['gened'] == $g['abbr'] ? "selected" : "" ?>>
											<?php echo $g['abbr'] . ' - ' . $g['name']; ?>
										</option>
									<?php }
								} ?>
							</select>

							<div class="input-group-append">
							  <button class="btn btn-primary" type="submit" name="updateG">Update</button>
							</div>
						</div>
					<?php } ?>

					<button class="btn btn-primary mt-3" type="submit" name="submitRemove">Remove from Library</button>
				</form>
			<?php } ?>
  	</div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
