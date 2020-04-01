<?php session_start();
$con = mysqli_connect('localhost', 'root', '', 'shoppingcart');
  
if(isset($_SESSION['id'])){
    $object = $_GET['object'];
    substr($object,1,-1);
    $arr=explode(',',$object);
    
    $userId = $_SESSION['id'];
    for($i=0;$i<count($arr);$i++){
        $productId=$arr[0];
        $quantity=$arr[1];
    }  
    $query="INSERT INTO orders(userID,productID,quantity) 
    VALUES ('$userId',' $productId','$quantity')";
    mysqli_query($con, $query);
}
mysqli_close($con);
?>