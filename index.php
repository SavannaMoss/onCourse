<?php

	include('config/db_connect.php');

	include('includes/session.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container" role="main">

      <?php if (!isset($_SESSION['id'])) { ?>
        <!-- show if logged out -->
				<h1>Welcome to onCourse!</h1>

        <div class="row">
          <div class="col-md-6 my-3">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Login</h2>
                <p class="card-text">Login to your account!</p>
                <a href="login.php" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>

          <div class="col-md-6 my-3">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Register</h2>
                <p class="card-text">Register for an account!</p>
                <a href="register.php" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>

          <div class="col-md-12 my-3">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">What is onCourse?</h2>
                <p class="card-text">onCourse is a tool for students to manage courses they have taken. It helps to keep track of the specific General Education credits they need to graduate on time. <strong>Register for an account today and keep yourself onCourse!</strong></p>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <!-- show if logged in -->
				<h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>

        <div class="row">
          <div class="col-md-4 my-3">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Course Library</h2>
                <p class="card-text">Visit your course library!</p>
                <a href="library.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>

					<div class="col-md-4 my-3">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Course Directory</h2>
                <p class="card-text">Visit the course directory!</p>
                <a href="directory.php" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>

          <div class="col-md-4 my-3">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Profile</h2>
                <p class="card-text">Visit your student profile!</p>
                <a href="profile.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
