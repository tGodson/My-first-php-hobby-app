<?php session_start();

	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

        $con = mysqli_connect('localhost', 'root', '', 'shoppingcart');

        // make a query
        $query = "SELECT id,email,passw,allname FROM user WHERE email='$email' && passw='$password'";
        $result = mysqli_query($con, $query);
        if($result->num_rows > 0){
           // create session and store user info 
           $user = $result->fetch_assoc();

           $_SESSION['id'] = $user['id'];
           $_SESSION['email'] = $user['email'];
           $_SESSION['passw'] = $user['passw'];
           $_SESSION['allname'] = $user['allname'];

           Header('Location: shoppingCart.php');
           echo "congratulations you are loged in";

        } else die('User does not exist');

	}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<title>Total Online Shopping Mall</title> 
</head>
<?php include('header.php') ?>
<body>
<h1>LogIn</h1>
	<form action="" method="post" style="text-align:center;">
		<input type="email" name="email" placeholder="Email"><br/>
		<input type="password" name="password" placeholder="Password" /><br/>
		<input type="submit" name="submit" value="Signin"/></br>&nbsp;<br/>&nbsp;<br/>
        please <a href='signup.php'>create an account</a> if you dont have one.
	</form>
    
</body>
</html>