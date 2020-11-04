<?php
  include('config/db_connect.php');

  include('includes/session.php');

  if (isset($_GET['searchterm']) && isset($_GET['src'])) {
    $searchterm = mysqli_real_escape_string($conn, $_GET['searchterm']);
    $src = mysqli_real_escape_string($conn, $_GET['src']);
    $found = mysqli_real_escape_string($conn, $_GET['found']);
  }

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>onCourse | Search Results </title>
   </head>
   <body>
     <div>
       <?php include('includes/header.php'); ?>
     </div>

     <div class="container">

       <h3 class="text-center">Search Results</h3>
       <p class="text-center">You searched for "<em><? echo $searchterm; ?></em>" in <?php echo $src == "library" ? "your course library" : "the course directory"; ?>.</p>

       <!-- RESULTS -->
       <?php if ($found) {
         $course_search = $_SESSION['searched'];

         foreach($course_search as $course) { ?>
           <div class="col-sm-12 my-3">
             <div class="card">
               <div class="card-body">
                 <h5 class="card-title"><?php echo htmlspecialchars($course['code']) . " " . htmlspecialchars($course['name']); ?></h5>
                 <p class="card-text float-left"><?php echo htmlspecialchars($course['description']); ?></p>
                 <a href="course.php?code=<?php echo htmlspecialchars($course['code']); ?>" class="btn btn-primary float-right">More Info</a>
               </div>
             </div>
           </div>
           <?php }
         } else { ?>
           <h5 class="text-center">No results found! Try another search.</h5>

           <?php if ($src == 'library') { ?>
             <p class="text-center mt-3"><a class="btn btn-primary" href="library.php?id=<?php echo $_SESSION['id']; ?>">Go Back</a></p>
           <?php } else { ?>
             <p class="text-center mt-3"><a class="btn btn-primary" href="directory.php?id=<?php echo $_SESSION['id']; ?>">Go Back</a></p>
           <?php }
          } ?>

     </div>

     <div>
       <?php include('includes/footer.php'); ?>
     </div>
   </body>
 </html>
