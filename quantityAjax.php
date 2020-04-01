<?php session_start();
if(isset($_SESSION['id'])){
$quantityStr= $_GET['quantityArr'];
//echo $quantityStr;

$quantityArr=explode(',', $quantityStr);
//print_r($quantityArr);
for($i=0;$i<count($quantityArr);$i++){
    $productId=$quantityArr[0];
    $quantity=$quantityArr[1];
}


    $con = mysqli_connect('localhost', 'root', '', 'shoppingcart');
    $userId = $_SESSION['id'];
    $query="UPDATE orders SET quantity='$quantity' WHERE userID='$userId' && productID='$productId'";
        mysqli_query($con, $query);
} 
mysqli_close($con);
?>