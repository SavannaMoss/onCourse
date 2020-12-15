<?php

	include('config/db_connect.php');

	include('includes/session.php');

  // COURSES
	$sql = "SELECT code, field, name, description FROM courses";

	$result = mysqli_query($conn, $sql);

	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// FIELDS OF STUDY
	$sql = "SELECT * FROM fields_study";

	$result = mysqli_query($conn, $sql);

	$fields = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

		header("Location: results.php?searchterm=".$searchterm."&src=directory&found=".$found);
	}
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

    <div class="container" role="main">

      <h1 class="text-center">Course Directory</h1>

      <div class="row">
        <div class="col-md-6 my-3">
					<!-- SEARCH BAR -->
					<form method="POST">
						<div class="input-group">
						  <input type="text" class="form-control" name="searchterm" placeholder="Search" required aria-required="true" aria-label="Search Bar">

						  <div class="input-group-append">
						    <button class="btn btn-primary" type="submit" name="submit" aria-label="Search Button"><i class="fas fa-search" alt="Magnifying glass icon. Links to search results."></i></button>
						  </div>
						</div>
					</form>
        </div>

				<!-- LIBRARY BUTTON -->
        <div class="col-md-6 my-3">
          <p><a class="btn btn-primary" style="width: 100%;" href="library.php?id=<?php echo $_SESSION['id']; ?>">Your Course Library</a></p>
        </div>
      </div>

      <!-- FIELD -->
			<?php foreach ($fields as $field) { ?>
	      <div class="card my-3">
	        <div class="card-header">
	          <h2 class="mb-0">
							<!-- CATEGORIZE BY DIFFERENT FIELDS -->
	            <button class="btn btn-drop" data-toggle="collapse" data-target="#<?php echo $field['abbr'] ?>">
	              <?php echo $field['abbr'] . " - " . $field['field'] ?>
	            </button>
	          </h2>
	        </div>

	        <div id="<?php echo $field['abbr'] ?>" class="collapse show">
	          <?php foreach($courses as $course) {
							if ($course['field'] == $field['abbr']) { ?>
								<div class="col-md-12 my-3">
		              <div class="card">
		                <div class="card-body">
		                  <h2 class="card-title"><?php echo htmlspecialchars($course['code']) . " " . htmlspecialchars($course['name']); ?></h2>
		                  <p class="card-text float-left"><?php echo htmlspecialchars($course['description']); ?></p>
		                  <a href="course.php?code=<?php echo htmlspecialchars($course['code']); ?>" class="btn btn-primary float-right">More Info</a>
		                </div>
		              </div>
		            </div>
							<?php }
	          } ?>
	        </div>
	      </div>
			<?php } ?>

    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
