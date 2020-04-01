<?php 
$product=array();
$productArr=array();
//if the user is loged in
if(isset($_SESSION['id'])){
    $user=$_SESSION["id"];
    $conn=mysqli_connect('localhost','root','','shoppingcart');
    $q="SELECT * FROM orders WHERE userID='$user'";
    $r=mysqli_query($conn, $q);
    
    if($r->num_rows > 0){
        while($line=$r->fetch_assoc()){
            $item=array('productID'=>$line['productID'],'quantity'=>$line['quantity']);
            array_push($product,$item);
        }
      
        for($i=0;$i<count($product);$i++){
            $obj=json_encode($product[$i]);
            array_push($productArr,$obj);
        }
           // print_r($productArr);
    
    }
   
}

?>
<script>
//if user has selected any product before
   if(<?php echo ''.count($product).' > 0' ?>){
        var cart = [<?php echo ''.implode(',', $productArr).'' ?>]; 
        console.log(cart);
        if(localStorage.getItem("cart")){
            var cart_extra = JSON.parse(localStorage.getItem('cart'));
            console.log(cart_extra);
            cartID=[];
            for(var i=0;i<cart.length;i++){
                cartID.push(cart[i].productID);
            }
            console.log(cartID);
            for(var i=0;i<cart_extra.length;i++){
                if(cartID.includes(cart_extra[i].productID)){
                    console.log('product already in cart')
                }else{
                    cart.push(cart_extra[i]);
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("test").innerHTML = this.responseText;
                        }
                    };
                    var object=[];
                    object.push(cart_extra[i].productID,cart_extra[i].quantity);
                    xhttp.open("GET", "onloadAjax.php?object="+object, true);
                    xhttp.send();
                }
            }

        }
        localStorage.setItem("cart", JSON.stringify(cart));
   }

    if(localStorage.getItem("cart")){
        var cart = JSON.parse(localStorage.getItem('cart'));
        console.log(cart);
        var quantitySum=0;
        if(cart.length>0){
            for(var i=0;i<cart.length;i++){
                quantitySum +=JSON.parse(cart[i].quantity);
            }
            document.getElementById("cartCount").innerHTML = quantitySum;
        }
    }
	
function addToCart(id) {
    var cartObj={
        productID:""+id+"",
        quantity:"1"
    }
    if(localStorage.getItem("cart")){
        var cart = JSON.parse(localStorage.getItem('cart'));
        var data = cart.find( function( obj ) { 
        return obj.productID == id;
        })
        if(data){
            console.log('product already in cart');
        }else{
            cart.push(cartObj);
            localStorage.setItem("cart", JSON.stringify(cart));
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("test").innerHTML = this.responseText;
                }
            };
            
            xhttp.open("GET", "productAjax.php?id="+id, true);
            xhttp.send();
        }
       
    } else {
        var cart = [];
        cart.push(cartObj);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("test").innerHTML = this.responseText;
            }
        };
    
        xhttp.open("GET", "productAjax.php?id="+id, true);
        xhttp.send();
        localStorage.setItem("cart", JSON.stringify(cart));
    }
    var quantitySum=0;
    for(var i=0;i<cart.length;i++){
        quantitySum +=JSON.parse(cart[i].quantity);
    }

    document.getElementById("cartCount").innerHTML = quantitySum;

    console.log(localStorage.getItem("cart"));
    //console.log(document.getElementById("quantity"+id+"").value);
}
</script>