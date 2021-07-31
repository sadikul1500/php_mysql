<?php
	$conn = mysqli_connect('localhost', 'sadikulsadi1500', 'iit123', 'user_database');
	
	if(!$conn){
		echo 'database connection error: ' . mysqli_connect_error();
	}
?>