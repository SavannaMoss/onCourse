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

    <div class="container">

      <?php if (!isset($_SESSION['id'])) { ?>
        <!-- show if logged out -->
				<h3>Welcome to onCourse!</h3>

        <div class="row">
          <div class="col-sm-6 my-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Login</h5>
                <p class="card-text">Login to your account!</p>
                <a href="login.php" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 my-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Register</h5>
                <p class="card-text">Register for an account!</p>
                <a href="register.php" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>

          <div class="col-sm-12 my-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">What is onCourse?</h5>
                <p class="card-text">Description</p>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <!-- show if logged in -->
				<h3>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>

        <div class="row">
          <div class="col-sm-6 my-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Course Library</h5>
                <p class="card-text">Visit your course library!</p>
                <a href="library.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">GO</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 my-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Profile</h5>
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
