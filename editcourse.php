<!-- POSSIBLY DELETE THIS PAGE -->

<?php include('includes/session.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>onCourse | Edit Course</title>
  </head>
  <body>
    <div>
      <?php include('includes/header.php'); ?>
    </div>

    <div class="container text-center">
  	   <h3>Edit Course</h3>
      <form>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Instructor</span>
          </div>
          <input type="text" class="form-control" value="Roberson">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Semester Taken</label>
          </div>
          <select class="custom-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="1">Fall 2020</option>
            <option value="2">Spring 2020</option>
            <option value="3">Fall 2019</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <div>
      <?php include('includes/footer.php'); ?>
    </div>
  </body>
</html>
