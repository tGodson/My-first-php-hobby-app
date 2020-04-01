<?php session_start();
$con = mysqli_connect('localhost', 'root', '', 'shoppingcart');
$ProductIds = $_GET['productID'];
$userId = $_SESSION['id'];

if(isset($_SESSION['id'])){
    $query="DELETE FROM orders WHERE userID='$userId' && productID='$ProductIds'";

        mysqli_query($con, $query);
}
mysqli_close($con);
?> 