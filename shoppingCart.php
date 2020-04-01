<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<title>Total Online Shopping Mall</title> 
</head>
<?php include('header.php') ?>
<?php include('product.php') ?>

<body>
 
<h1>SHOPPING CART</h1>

<?php
$con = mysqli_connect('localhost', 'root', '', 'shoppingcart');

// make a query
$query = "SELECT id,itemImage,itemName,itemPrice FROM cart";
$result = mysqli_query($con, $query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<div class='product'><div class='product-image'>
        <img src='uploads/" . $row["itemImage"]. "' alt='about us' class='index-picture'/></div><br/> 
        " . $row["itemName"]. "/" . $row["itemPrice"]. "FCFA<br>
    
        <input type='button' name='submit' value='Add to cart' onclick='addToCart(".$row["id"].")'/></div>";
    }
} else {
    echo "0 results";
}
mysqli_close($con);

?>
<script type="text/javascript" src="logout.js"></script>
</body>
</html>