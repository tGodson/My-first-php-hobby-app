<div class="header">
    <div class="menu">
       
        <?php if(!isset($_SESSION['id'])){ ?>
            <a href="index.php">Home</a>
            <a href="signup.php">Signup</a>
            <a href="login.php">Sigin In</a>
        <?php } else echo "<a href='#' onclick='logout()'>Logout</a>&nbsp;&nbsp;&nbsp;<a href='add-product.php'>Add Product</a>
        <a href='shoppingCart.php'>".$_SESSION['allname']."</a>&nbsp;&nbsp;&nbsp;"; ?>
    </div>
    <div class="cart">
        <a href="cart.php"><div id="cartCount">0</div></a>
        <a><div id="test"></div></a>
    </div>
   
    
</div>