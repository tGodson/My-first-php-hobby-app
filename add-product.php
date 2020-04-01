<?php session_start();
$nameErr=$priceErr=$quantityErr=$descriptionErr=$imageErr="";
$name=$price=$quantity=$description=$image="";
	if(isset($_POST['submit'])){

		if(empty($_POST['name'])){
			$nameErr ='please fill in the name of the product';
		}else{
			$name=$_POST['name'];
		}
		if(empty($_POST['price'])){
			$priceErr ='please fill in the price of the product';
		}else{
			$price=$_POST['price'];
		}
		if(empty($_POST['quantity'])){
			$quantityErr ='please fill in the quantity of the product';
		}else{
			$quantity=$_POST['quantity'];
		}
		if(empty($_POST['description'])){
			$descriptionErr ='please fill in the description of the product';
		}else{
			$description=$_POST['description'];
		}
		if (!empty($_FILES['image'])) {
		
			$image =$_FILES['image'];
		  }

		if($nameErr==''&& $priceErr=='' && $quantityErr=='' && $descriptionErr==''){
			// upload 
			$upload_dir = "uploads/";

			$tmp = $_FILES['image']['tmp_name'];
			$image = $_FILES['image']['name'];

			move_uploaded_file($tmp, $upload_dir.$image);

			$con = mysqli_connect('localhost', 'root', '', 'shoppingcart');

			$sql1= "SELECT itemName FROM cart WHERE itemName='$name'";

			if(mysqli_query($con, $sql1)->num_rows > 0){
				$nameErr="please this item name already exist in our database<br>";
			}

			// make a query
			if($nameErr==''){
				mysqli_query($con, "INSERT INTO cart (itemName, itemPrice, quantity, itemDescription, itemImage)
				VALUES('$name', '$price', '$quantity', '$description', '$image')");
				if(mysqli_error($con)) die("Unsuccessful");
			
				Header('Location: shoppingCart.php');
			}
		}
	}


?>


<!DOCTYPE html>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<title>Add Product</title>
</head>
<body>
    <?php include('header.php') ?>
    <h1>Add New Product</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="name" name="name" placeholder="Product name" value="<?php echo $name;?>"/><br>
			<span class="error">* <?php echo $nameErr;?></span><br/>
		<input type="number" name="price" placeholder="Price" value="<?php echo $price;?>"><br>
			<span class="error">* <?php echo $priceErr;?></span><br/>
		<input type="number" name="quantity" placeholder="Quantity" value="<?php echo $quantity;?>"/><br>
			<span class="error">* <?php echo $quantityErr;?></span><br/>
		<textarea name="description" rows="5" cols="40" placeholder="Description"><?php echo $description;?></textarea><br/>
			<span class="error">* <?php echo $descriptionErr;?></span><br/>
		<input type="file" name="image" value="<?php echo $image;?>"/><br>
		<span class="error">* <?php echo $imageErr;?></span><br/>
		<input type="submit" name="submit" value="Add Product"/>
	</form>
</body>
</html>