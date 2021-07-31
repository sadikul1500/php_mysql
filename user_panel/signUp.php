<?php
	
	session_start();
	include('db_connect.php');
	//include('home.php');
	
	function validate_username($name){
		$allowed = array(".", "-", "_", '%'); 
		if(ctype_alnum(str_replace($allowed, '', $name ))) {
			return 1;
		} else {
			//$str = "Invalid Username";
			return 0;
		}
	}
	
	function validate_password($pass){
		if (strlen($pass) < '4') {
			return "Your Password Must Contain At Least 4 Characters!";
			//return 0;
		}
		elseif(!preg_match("#[0-9]+#",$pass)) {
			return "Your Password Must Contain At Least 1 Number!";
			//return 0;
		}
		elseif(!preg_match("#[A-Z]+#",$pass)) {
			return "Your Password Must Contain At Least 1 Capital Letter!";
		}
		elseif(!preg_match("#[a-z]+#",$pass)) {
			return"Your Password Must Contain At Least 1 Lowercase Letter!";
		}
		
		return "1";
	}
	
	
	$userName = $password = $confirm_password = "";
	$errors = array('userName'=> '', 'password'=> '', 'confirm_password'=> '');
	$id = 0;
	
	if(isset($_POST['submit'])){
		//session_start();
		$userName = mysqli_real_escape_string($conn, $_POST['userName']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
		//echo $confirm_password;
		
		if (empty($userName)){
			$errors['userName'] = 'a username is required<br>';
		}
		
		if (empty($password)){
			$errors['password'] = 'a password is required<br>';
		}
		
		if($password != $confirm_password){
			$errors['confirm_password'] = 'please retype the same password<br>';
		}
		
		//echo count($errors);
		
		if (array_filter($errors)){
			$id = 1; //error('try again');
		}
		
		else{
			if(!validate_username($userName))
			{
				$errors['userName'] = "username can contain only alphanumeric values and ['.', '_', '-', '%']";
				//header('location:SignUp.php');
			}
			
			if(validate_password($password) != "1")
			{
				$errors['password'] = validate_password($password);
				//header('location:SignUp.php');
			}
			
			else{
				$sql = "select * from users where user_name='$userName'";
				$result = mysqli_query($conn, $sql);
				
				if(mysqli_num_rows($result) == 0){
				
					$sql = "insert into users(user_name, password) values('$userName', '$password')";
					$result = mysqli_query($conn, $sql);
					//echo 'okay';
				
					if($result){
						//echo 'submitted<br>';
						$_SESSION['message'] = "new account created successfully";
						$_SESSION['userName'] = $userName;
						
						mysqli_free_result($result);
						header('location:home.php');
					
						//header('Location: index.php');
					}
				}
				else{
					$id = 2; //error('registration error: The username already exists') ;
				}
			}
			
			
				//$password = md5($password);
				
			
			
		}
		
		
	
	}
	mysqli_close($conn);
	
?>

<html>
	<head>
		<title>sign up</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<?php include('template/signIn_signUp.php'); ?>
		<section class="container grey-text">
			<h4 class="center">Create an account</h4>
			<form class="white" action=""<?php echo $_SERVER['PHP_SELF']?>"" method="POST"> 
			
				<label> UserName:</label>
				<input type="text" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
				<div class="red-text"><?php echo $errors['userName']; ?></div>
				<!--<?php $errors['email'] = ''; $email= ' ';?> -->
			
			
			
				<label> Password:</label>
				<input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
				<div class="red-text"><?php echo $errors['password'];?></div>
			
			
			
				<label> Confirm Password:</label>
				<input type="password" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>">
				<div class="red-text"><?php echo $errors['confirm_password'];?></div>			
			
				<div class="center">
					<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
				</div>
				<p>
					Has an account? <a href="SignIn.php">Sign_In</a>
				</p>
				
			</form>
		</section>
		<?php
			if($id == 1){
				//echo '<script>','error("wrong!!!Try again");','</script>';
			}
			if($id==2){
				echo '<script>','error("registration error: username already exists");','</script>';
			}
		?>
		
		<?php include('template/footer.php');?>
	</body>


</html>