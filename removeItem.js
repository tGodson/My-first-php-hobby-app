function remove(id) {
			
    var cart = JSON.parse(localStorage.getItem('cart'));
    
        for(var i=0; i<cart.length; i++){
            //console.log(cart[i],id)
            if(cart[i]==id){
                console.log(cart[i],id)
                cart.splice(i,1);
                localStorage.setItem("cart", JSON.stringify(cart));

            }else{
                console.log('ids dnt match');
            }
        }
        window.location.reload();
}