<?php

	include('config/db_connect.php');

	include('includes/session.php');

	// Check for course to display
	if (isset($_GET['code'])) {
			$code = mysqli_real_escape_string($conn, $_GET['code']);

	    $sql = "SELECT * FROM courses WHERE code = '$code'";

			$result = mysqli_query($conn, $sql);

			$course = mysqli_fetch_assoc($result);

			mysqli_free_result($result);

			mysqli_close($conn);
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

      <p><span class="detail">Department: </span>Computer Science</p>
      <p><span class="detail">Instructor: </span><?php echo htmlspecialchars($course['instructor']); ?></p>
      <p><span class="detail">Credits: </span><?php echo htmlspecialchars($course['hours']); ?></p>
      <p><span class="detail">GenEd: </span><?php echo htmlspecialchars($course['gened']); ?></p>
      <p><span class="detail">Description: </span><?php echo htmlspecialchars($course['description']); ?></p>
      <!-- <p><span class="detail">Semester Taken: </span>Spring 2020</p> -->

      <!-- <p><a class="btn btn-primary" href="editcourse.php?code=<?php echo $course['code']; ?>">Edit</a></p> -->

			<!-- MAKE ONE AVAILABLE DEPENDING ON IF COURSE IS IN USER LIBRARY OR NOT -->
      <p><a class="btn btn-primary" href="">Add to Library</a></p>
      <p><a class="btn btn-primary" href="">Remove from Library</a></p>
  	</div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
