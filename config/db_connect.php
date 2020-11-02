<?php

	// connect to the database
	$conn = mysqli_connect('localhost', 'root', 'root', 'oncourse');

	// $conn = mysqli_connect('localhost', 'root', 'testing123', 'oncourse'); // for AWS

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>
