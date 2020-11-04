<?php

	include('config/db_connect.php');

	include('includes/session.php');

	// Check for info to display
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);

	// USER'S CREDITS
	$sql = "SELECT * FROM users WHERE id = $id";

	$result = mysqli_query($conn, $sql);

	$user = mysqli_fetch_assoc($result);

	$credits_needed = 124 - $user['credits'];

  // USER'S COURSES
	$sql = "SELECT c.code, c.name, c.description, uc.current FROM courses AS c INNER JOIN user_courses AS uc ON uc.userid = $id AND c.code = uc.coursecode";

	$result = mysqli_query($conn, $sql);

	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($conn);

	// SEARCH BAR FUNTIONALITY
	if (isset($_POST['submit'])) {
		$searchterm = $_POST['searchterm'];

		$key = 0;

		foreach ($courses as $c) {
			$title = $c['code']." ".$c['name'];
			if (stristr($title, $searchterm)) {
				$course_search[$key] = $c;
				$key += 1;
			}
		}

		if (empty($course_search)) {
			$found = false;
		} else {
			$_SESSION['searched'] = $course_search;
			$found = true;
		}

		header("Location: results.php?searchterm=".$searchterm."&src=library&found=".$found);
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Library</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container">

      <h3 class="text-center">Course Library</h3>

      <div class="row">
        <div class="col-sm-3 my-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Credits Taken</h5>
              <p class="card-text"><?php echo $user['credits']; ?></p>
            </div>
          </div>
        </div>

        <div class="col-sm-3 my-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Credits Needed</h5>
              <p class="card-text"><?php echo $credits_needed; ?></p>
            </div>
          </div>
        </div>

        <div class="col-sm-6 my-3">
					<!-- SEARCH BAR -->
					<form method="POST">
						<div class="input-group">
						  <input type="text" class="form-control" name="searchterm" placeholder="Search">
						  <div class="input-group-append">

						    <button class="btn btn-primary" type="submit" name="submit" id="button-addon1"><i class="fas fa-search"></i></button>
						  </div>
						</div>
					</form>

					<!-- DIRECTORY BUTTON -->
          <p><a class="btn btn-primary mt-4" style="width: 100%;" href="directory.php">Find New Courses</a></p>
        </div>
      </div>

      <div id="accordion">

        <!-- Current Courses -->
        <div class="card my-3">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-drop" data-toggle="collapse" data-target="#collapseOne">
                Current Courses
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show">

							<?php foreach($courses as $course) {
								if ($course['current'] == 1) { ?>
										<div class="col-sm-12 my-3">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title"><?php echo $course['code'] . " " . $course['name']; ?></h5>
													<p class="card-text float-left"><?php echo $course['description']; ?></p>
													<a href="course.php?code=<?php echo $course['code']; ?>" class="btn btn-primary float-right">More Info</a>
												</div>
											</div>
										</div>
								<?php	}
							} ?>

          </div>
        </div>

				<!-- Past Courses -->
        <div class="card my-3">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-drop" data-toggle="collapse" data-target="#collapseTwo">
                Past Courses
              </button>
            </h5>
          </div>

          <div id="collapseTwo" class="collapse">

							<?php foreach($courses as $course) {
								if ($course['current'] == 0) { ?>
										<div class="col-sm-12 my-3">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title"><?php echo $course['code'] . " " . $course['name']; ?></h5>
													<p class="card-text float-left"><?php echo $course['description']; ?></p>
													<a href="course.php?code=<?php echo $course['code']; ?>" class="btn btn-primary float-right">More Info</a>
												</div>
											</div>
										</div>
								<?php	}
							} ?>

          </div>
        </div>
      </div>

    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>

  </body>
</html>
