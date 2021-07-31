<?php
	session_start();
	include('db_connect.php');
	//include('home.php');
	
	$userName = $password = "";
	$errors = array('userName'=> '', 'password'=> '');
	$id = 0;
	if(isset($_POST['submit'])){
		$userName = mysqli_real_escape_string($conn, $_POST['userName']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		if (empty($userName)){
			$errors['userName'] = 'a username is required<br>';
		}
		
		if (empty($password)){
			$errors['password'] = 'a password is required<br>';
		}
		
		if (array_filter($errors)){
			$id = 1;
		}
		
		else{
			$sql = "select * from users where user_name='$userName' and password='$password'";
			$result = mysqli_query($conn, $sql);
			//echo 'result<br>';
			//echo $result;
			if(mysqli_num_rows($result) == 1){
				$_SESSION['message'] = "logged in successfully";
				$_SESSION['userName'] = $userName;
			
				header('location:home.php');
			}
			
			else{
				$id = 2;//error('username or password is invalid. Please try again.');
				//header('location:signIn.php');
			}
		}
	}
?>

<html>
	<head>
		<title>Sign In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<?php include('template/signIn_signUp.php'); ?>
		<section class="container grey-text">
			<h4 class="center">Sign In to proceed</h4>
			<form class="white" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST"> 
				<label> UserName:</label>
				<input type="text" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
				<div class="red-text"><?php echo $errors['userName']; ?></div>
				
				<label> Password:</label>
				<input type="password" name="password" value="<?php echo htmlspecialchars($password);?>">
				<div class="red-text"><?php echo $errors['password'];?></div>
				
				<div class="center">
					<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
				</div>
				
				<p>
					No accounts yet? <a href="SignUp.php">Sign_Up</a>
				</p>
			</form>
		</section>
		
		<?php
			if($id == 1){
				//echo '<script>','error("Try again");','</script>';
			}
			if($id==2){
				echo '<script>','error("username or password is invalid. Please try again.");','</script>';
			}
				
		?>
		<?php include('template/footer.php');?>
	</body>


</html>