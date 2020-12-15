<?php

	include('config/db_connect.php');

	include('includes/session.php');

	// Check for profile to display
	if (isset($_SESSION['id'])) {
		$id = mysqli_real_escape_string($conn, $_SESSION['id']);

		$sql = "SELECT * FROM users WHERE id = $id";

		$result = mysqli_query($conn, $sql);

		$user = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

		mysqli_close($conn);
	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Profile</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container text-center" role="main">
      <h1><?php echo htmlspecialchars($user['name']); ?></h1>

      <p><span class="detail">Major: </span><?php echo htmlspecialchars($user['major']); ?></p>
      <p><span class="detail">Credits: </span><?php echo htmlspecialchars($user['credits']); ?></p>
			<p><span class="detail">GenEd Credits: </span><?php echo htmlspecialchars($user['gened_credits']); ?></p>

      <p><a class="btn btn-primary" href="editprofile.php?id=<?php echo htmlspecialchars($user['id']); ?>">Edit</a></p>
      <p>
				<a class="btn btn-primary" href="library.php?id=<?php echo htmlspecialchars($user['id']); ?>">Course Library</a>
				<a class="btn btn-primary ml-2" href="credits.php?id=<?php echo htmlspecialchars($user['id']); ?>">GenEd Credits</a>
			</p>

  	</div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
