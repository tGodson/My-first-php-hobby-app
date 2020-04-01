<?php session_start();
$con = mysqli_connect('localhost', 'root', '', 'shoppingcart');

//print_r($cartObj);
if(isset($_SESSION['id'])){
    $id = $_GET['id'];
    $userId = $_SESSION['id'];
    $query="INSERT INTO orders(userID,productID,quantity) 
        VALUES ('$userId','$id','1')";
        mysqli_query($con, $query);
}
mysqli_close($con);
?>