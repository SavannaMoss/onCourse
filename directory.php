<?php

	include('config/db_connect.php');

	include('includes/session.php');

  // COURSES
	$sql = "SELECT code, name, description FROM courses";

	$result = mysqli_query($conn, $sql);

	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// MAJORS
	$sql = "SELECT major FROM majors";

	$result = mysqli_query($conn, $sql);

	$majors = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Directory</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container">

      <h3 class="text-center">Course Directory</h3>

      <div class="row">
        <div class="col-sm-6 my-3">
          <form method="POST">
            <div class="input-group">
              <input type="search" class="form-control" placeholder="Search">
            </div>
          </form>
        </div>
        <div class="col-sm-6 my-3">
          <p><a class="btn btn-primary" style="width: 100%;" href="library.php?id=<?php echo $_SESSION['id']; ?>">Your Course Library</a></p>
        </div>
      </div>

      <!-- MAJOR -->
      <div id="accordion">
        <div class="card my-3">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
							<!-- CATEGORIZE BY DIFFERENT MAJORS -->
              <button class="btn btn-drop" data-toggle="collapse" data-target="#collapseOne">
                Computer Science
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show">
            <?php foreach($courses as $course) { ?>
              <div class="col-sm-12 my-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($course['code']) . " " . htmlspecialchars($course['name']); ?></h5>
                    <p class="card-text float-left"><?php echo htmlspecialchars($course['description']); ?></p>
                    <a href="course.php?code=<?php echo htmlspecialchars($course['code']); ?>" class="btn btn-primary float-right">More Info</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <!-- MAJOR -->
      <div id="accordion">
        <div class="card my-3">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-drop" data-toggle="collapse" data-target="#collapseOne">
                Computer Science
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show">
            <?php foreach($courses as $course) { ?>
              <div class="col-sm-12 my-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($course['code']) . " " . htmlspecialchars($course['name']); ?></h5>
                    <p class="card-text float-left"><?php echo htmlspecialchars($course['description']); ?></p>
                    <a href="course.php?code=<?php echo htmlspecialchars($course['code']); ?>" class="btn btn-primary float-right">More Info</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>

    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
