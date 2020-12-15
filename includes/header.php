<head>
	<title>onCourse</title>
	<?php include('imports.php'); ?>

	<link rel="shortcut icon" type="image/icon" href="images/favicon.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<header role="banner">
		<nav class="navbar navbar-expand-lg navbar-light mb-5" role="navigation">

			<!-- LOGO -->
			<a class="navbar-brand" href="index.php">
	    	<img src="images/icon.png" width="50" height="50" alt="White comet icon. Links to dashboard.">
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
					</ul>
					<?php } else { ?>
						<!-- show if logged in -->
						<li class="nav-item">
			        <a class="nav-link text-white" href="library.php?id=<?php echo $_SESSION['id']; ?>">Course Library</a>
			      </li>
						<li class="nav-item">
			        <a class="nav-link text-white" href="directory.php">Course Directory</a>
			      </li>
						<li class="nav-item">
			        <a class="nav-link text-white" href="credits.php?id=<?php echo $_SESSION['id']; ?>">GenEd Credits</a>
			      </li>
					</ul>
					<ul class="navbar-nav">
						<li class="nav-item float-right">
			        <a class="nav-link text-white" href="profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="far fa-user" title="Profile" alt="Profile"></i></a>
			      </li>
						<li class="nav-item float-right">
			        <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt" title="Logout" alt="Logout"></i></a>
			      </li>
					</ul>
					<?php } ?>
			</div>
		</nav>
	</header>
</body>
