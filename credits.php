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

	$gened_credits_needed = 42 - $user['gened_credits'];

  // USER'S COURSES
	$sql = "SELECT c.code, c.field, c.name, c.geneds, c.description, uc.current, uc.gened FROM courses AS c INNER JOIN user_courses AS uc ON uc.userid = $id AND c.code = uc.coursecode";

	$result = mysqli_query($conn, $sql);

	$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	// GENEDS
	$sql = "SELECT * FROM geneds";

	$result = mysqli_query($conn, $sql);

	$geneds = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | GenEd Credits</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container" role="main">

      <h1 class="text-center">Your GenEd Credits</h1>

			<!-- button trigger modal -->
			<div class="text-center">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
					See a breakdown! <i class="far fa-chart-bar" alt="Bar chart icon"></i>
				</button>
			</div>

      <div class="row">
        <div class="col-md-3 my-3">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Credits Taken</h2>
              <p class="card-text"><?php echo $user['credits'] < 0 ? 0 : $user['credits']; ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-3 my-3">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Credits Needed</h2>
              <p class="card-text"><?php echo $credits_needed < 0 ? 0 : $credits_needed; ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-3 my-3">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">GenEd Credits Taken</h2>
              <p class="card-text"><?php echo $user['gened_credits'] < 0 ? 0 : $user['gened_credits']; ?></p>
            </div>
          </div>
        </div>

        <div class="col-md-3 my-3">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">GenEd Credits Needed</h2>
              <p class="card-text"><?php echo $gened_credits_needed < 0 ? 0 : $gened_credits_needed; ?></p>
            </div>
          </div>
        </div>
      </div>

			<!-- GENED -->
			<?php foreach ($geneds as $gened) {
				if ($gened['abbr'] != 'N/A') { ?>
					<div class="card my-3">
						<div class="card-header">
							<h2 class="mb-0">
								<!-- CATEGORIZE BY GENEDS -->
								<button class="btn btn-drop" data-toggle="collapse" data-target="#<?php echo $gened['abbr'] ?>">
									<?php echo $gened['abbr'] . " - " . $gened['name'] ?>
								</button>
							</h2>
						</div>

						<div id="<?php echo $gened['abbr'] ?>" class="collapse show">
							<?php foreach($courses as $course) {
								if (stristr($course['gened'], $gened['abbr'])) { ?>
									<div class="col-md-12 my-3">
										<div class="card h-100">
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
				<?php }
			} ?>

    </div>

		<!-- Modal -->
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title" style="color: #0c164f" id="modalTitle">GenEd Credit Breakdown</h1>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php include('includes/chart.php'); ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>

  </body>
</html>
