<?php session_start() ?>
<!DOCTYPE HTML>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<title>Total Online Shopping Mall</title> 
</head>
<?php include('header.php') ?>
<body>

<?php

$nameErr=$emailErr=$numberErr=$passwordErr=$cornfirmPassErr='';
$name=$email=$number=$password=$password2=$comment='';
	if(isset($_POST['submit'])){

		if(empty($_POST['name'])){
			$nameErr='please fill in your name';	
		
		}else {
			$name = $_POST['name'];	
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed";

			}
		}

		if(empty($_POST['email'])){
			$emailErr='please fill in your email';		
		}else {
			$email = $_POST['email'];

			$email = test_input($email);
			// check if e-mail address is well-formed
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$emailErr = "invalid email format. ";
			}	
		}

		if(empty($_POST['number'])){
			$numberErr='please fill in your number';
		}else{
			$number = $_POST['number'];
			 if (!preg_match('/^[0-9]*$/',$number)) {
       
				$numberErr='please fill in only numbers from 1 to 9';
			}	
		}

		if(empty($_POST['password'])){
			$passwordErr='please fill in your password';
		}else{
			$password=$_POST['password'];
		}

		if(empty($_POST['password2'])){
			$cornfirmPassErr='please cornfirm your password';
		}else{ 
			$password2=$_POST['password2'];
			if($password2!==$password){
				$cornfirmPassErr='your password do not match! Please check and confirm';
			}
		}
		if (!empty($_POST["comment"])) {
		
			$comment = test_input($_POST["comment"]);
		  }

		if($nameErr==''&& $emailErr=='' && $numberErr=='' && $passwordErr=='' && $cornfirmPassErr==''){ 

			$host = "localhost";
			$dbusername = "root";
			$dbpassword = "";
			$dbname = "shoppingcart";

			$con = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

			if (mysqli_connect_error()){
				die('Connect Error ('. mysqli_connect_error() .') '
				. mysqli_connect_error());
			}else{
				echo 'connection succesful<br>';
			}

			$sql1= "SELECT allname FROM user WHERE allname='$name'";
			$sql2= "SELECT email FROM user WHERE email='$email'";
			$sql3= "SELECT phonenum FROM user WHERE phonenum='$number'";
			//$result = mysqli_query($con, $sql);
			if(mysqli_query($con, $sql1)->num_rows > 0){
				$nameErr="please this name already exist in our database<br>";
			}
			if(mysqli_query($con, $sql2)->num_rows > 0){
				$emailErr="please this email already exist in our database<br>";
			}
			if(mysqli_query($con, $sql3)->num_rows > 0){
				$numberErr="please this phone number already exist in our database<br>";
			}

			if($nameErr==''&& $emailErr=='' && $numberErr==''){
				$query="INSERT INTO user(allname, email, phonenum, passw, comment ) 
					VALUES ('$name', '$email', '$number','$password','$comment')";

				if(mysqli_query($con, $query)){
					
		echo "<h2>Your Input:</h2>";
		echo $name;
		echo "<br>";
		echo $email;
		echo "<br>";
		echo $number;
		echo "<br>";
		echo $password;
		echo "<br>";
		echo $password2;
		echo "<br>";
		echo $comment;
		echo "<br>";

					echo "Records inserted successfully.";
				} else{
					die("ERROR: Could not able to execute $query. " . mysqli_error($con));
				} 
				// Close connection
				mysqli_close($con);
			}
								
		}else{
			echo "error: please crossCheck you form for errors";
		
		}
		
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>

<h1>Sign Up</h1>
	<form action="" method="post" style="text-align:center;">
	 Name: 	<input type="name" name="name" placeholder="Enter name" value="<?php echo $name;?>"/><br/>
				<span class="error">* <?php echo $nameErr;?></span><br/>
	Email: 	<input type="text" name="email" placeholder="Email e.g sss@bbb.ccc" value="<?php echo $email;?>"/><br/>
				<span class="error">* <?php echo $emailErr;?></span><br/>
   Number: <input type="text" name="number" placeholder="Phone Number" value="<?php echo $number;?>"/><br/>
				<span class="error">* <?php echo $numberErr;?></span><br/>
 Password:  <input type="password" name="password" placeholder="Password" value="<?php echo $password;?>"/><br/>
				<span class="error">* <?php echo $passwordErr;?></span><br/>
Confirm Password:  <input type="password" name="password2" placeholder="Confirm Password" value="<?php echo $password2;?>"/><br/>
				<span class="error">* <?php echo $cornfirmPassErr;?></span><br/>
 Message:  <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea><br/><br/>
				<input type="submit" name="submit" value="Signup"/><br/>&nbsp;<br/>&nbsp;<br/>
				Please <a href='login.php'>sign in Here</a> if you already have an account.
	</form>
	
	<?php


?>
</body>
</html>

