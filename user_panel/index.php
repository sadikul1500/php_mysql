<?php
	session_start();
	//$id = 0;
	
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['userName']);
	}
	
	elseif(isset($_SESSION['userName'])){
		//$id = 1; //echo 'no';
		//echo '<script type="text/javascript">','error();','</script>';
		//echo 'ok';
		header('location:home.php');
	}
	
?>


<html>
	<head>
		<title>Index Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="javascript.js"></script>
	</head>
	
	<body>
		<?php include('template/header.php') ?>
		<?php include('template/footer.php') ?>
		<!-- <script> alert('')</script> -->
		<!--
		
		-->
	</body>
</html>