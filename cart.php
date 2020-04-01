<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping cart</title>
	<link href="style.css" rel="stylesheet" />
</head>
<body>
    <?php include('header.php') ?>
    <?php include('removeItem.php') ?>
    <?php include('product.php') ?>
    <?php include('quantity.php') ?>

    <p id="demo"></p>
     
    <script>
    var arr=[];
    var cart=JSON.parse(localStorage.getItem('cart'));
    for(var i=0;i<cart.length;i++){
      arr.push([cart[i].productID,cart[i].quantity]);
    }
    var arr2=JSON.stringify(arr);
    console.log(arr);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "ajax.php?id="+arr2, true);
      xhttp.send();
    
    </script>
    <script type="text/javascript" src="logout.js"></script>
</body>
</html>