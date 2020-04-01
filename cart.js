if(localStorage.getItem("cart")){
    var cart = JSON.parse(localStorage.getItem('cart'));
    if(cart.length>0){
        document.getElementById("cartCount").innerHTML = cart.length;
    }

   
}
