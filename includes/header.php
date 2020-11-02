<head>
	<title>onCourse</title>
	<?php include('imports.php'); ?>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light mb-5">

		<!-- LOGO -->
		<a class="navbar-brand" href="index.php">
    	<img src="images/icon.png" width="50" height="50" alt="">
  	</a>

		<!-- SITE NAME -->
		<a class="navbar-brand text-white" href="index.php">onCourse</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
	    <span class="navbar-toggler-icon"></span>
	  </button>

		<!-- LINKS -->
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
				<li class="nav-item">
	        <a class="nav-link text-white" href="index.php">Dashboard</a>
	      </li>
				<?php if (!isset($_SESSION['id'])) { ?>
					<!-- show if logged out -->
					<li class="nav-item">
		        <a class="nav-link text-white" href="login.php">Login</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-white" href="register.php">Register</a>
		      </li>
				<?php } else { ?>
					<!-- show if logged in -->
					<li class="nav-item">
		        <a class="nav-link text-white" href="library.php?id=<?php echo $_SESSION['id']; ?>">Course Library</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-white" href="profile.php?id=<?php echo $_SESSION['id']; ?>">Profile</a>
		      </li>
					<li class="nav-item">
		        <a class="nav-link text-white" href="logout.php">Logout</a>
		      </li>
				<?php } ?>
			</div>
	</nav>
</body>
