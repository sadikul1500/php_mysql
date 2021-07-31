<?php
	//include('index.php')
	session_start();
	
?>

<html>
	<head>
		<title>Home Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>

	<body>
		<?php if(isset($_SESSION['message'])): ?>
			<h1 style="text-align:center;">Home Page </h1> 
			<h2>
				<?php
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				
				?>
			</h2>
		<?php endif ?>
		
		<?php if(isset($_SESSION['userName'])): ?>
			
			<p> Welcome home <strong><?php echo $_SESSION['userName']; ?></strong></p> 
			<p> <a href="index.php?logout='1'" style="color: blue";>log out</a></p> 
		
		<?php else: ?>
			<?php
				header('location:index.php')
			?>	
		
		<?php endif ?>
		
		
		
	</body>

</html>