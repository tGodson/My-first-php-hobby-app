<?php session_start();
$id = $_GET['id'];
//var_dump(json_decode($id));
//$id=explode(',', $id);
$idQty=json_decode($id);
//$id=json_decode($id,true);
//echo $id;
//print_r($idQty);
    /*foreach($idQty as $prop){
        $productId=$prop[0];
   $quantity=$prop[1];
   echo $productId;
   echo $quantity;
    }*/

$grandTotal=0;

$con = mysqli_connect('localhost', 'root', '', 'shoppingcart');

echo "<table style='width 70%;text-align:center;'>
    <tr>
        <th style='width:90px;'>Image</th>
        <th style='width:200px;'>Name</th>
        <th style='width:150px;'>Quantity</th>
        <th style='width:160px;'>Unit Price (FCFA)</th>
        <th style='width:160px;'>Total Price (FCFA)</th>
        <th></th>
    </tr>
    </table>";

if(count($idQty)!==0){
   
   
   foreach($idQty as $prop){
        $productId=$prop[0];
        $quantity=$prop[1];

        $totalPrice=0;
        /*if(isset($_SESSION['id'])){
            $userId = $_SESSION['id'];
            $query = "SELECT * FROM orders WHERE userID='$userId' && productID=".$productId;
            $r = mysqli_query($con, $query);

            if ($r->num_rows > 0) {
                while($line = $r->fetch_assoc()) {
                    $quantity=$line["quantity"];
                    array_push($quantityArr,$quantity);
                }
            }
        }*/
    
            $q = "SELECT * FROM cart WHERE id=".$productId;
            $result = mysqli_query($con, $q);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  
                    $totalPrice =$quantity* $row["itemPrice"];
                    echo " 
                    <table style='width:70%;text-align:center;'>
                        <tr>
                            <td style='width:90px;height:90px;'><img src='uploads/" . $row["itemImage"]. "' alt='about us' style='width:90px;height:90px;' /></td>
                            <td style='width:200px;'>" . $row["itemName"]. "</td>
                            <td style='width:150px;'>
                            <input style='width:80px;text-align:center;' id='".$row["id"]."' type='number' name='quantity' onChange='quantityChange(".$row["id"].")' value=".$quantity." min='1' />
                            </td>
                            <td style='width:140px;'>" . $row["itemPrice"]. "</td>
                            <td style='width:140px;'>" .$totalPrice. "</td>
                            <td><button onclick='remove(".$row["id"].")'>Remove Item</button></td>
                        </tr>
                    </table>";
                    $grandTotal +=$totalPrice;
                }
            } else {
                echo 'Please add some items to cart';
            }
    
    }
}else{
    echo '<b>No product Selected yet. Please select a product</b>';
}

echo " 
<table style='width:70%;text-align:center;'>
    <tr>
        <td style='width:90px;height:90px;'><b>TOTAL</b></td>
        <td style='width:200px;'></td>
        <td style='width:120px;'></td>
        <td style='width:120px;'></td>
        <td style='width:100px;'>".$grandTotal."</td>
        <td><a href='payment.php'><button style='background-color:green;font-size:20px;padding:15px;width:150px'>Make Payment</button></a></td>
    </tr>
    <tr>
        <td style='width:90px;height:90px;'></td>
        <td style='width:200px;'></td>
        <td style='width:150px;'></td>
        <td style='width:150px;'></td>
        <td style='width:140px;'></td>
        <td ><a  href='shoppingCart.php'><button style='background-color:green;font-size:20px;padding:15px;width:150px'>Continue Shopping</button></a></td>
    </tr>
</table>";

$con->close();

?>

