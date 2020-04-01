<script>

function remove(id) {
			
var cart = JSON.parse(localStorage.getItem('cart'));

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "removeAjax.php?productID="+id, true);
    xhttp.send();

    for(var i=0; i<cart.length; i++){
        //console.log(cart[i],id)
        if(cart[i].productID==id){
          console.log(cart[i],id)
            cart.splice(i,1);
            localStorage.setItem("cart", JSON.stringify(cart));
 
        }else{
            console.log('ids dnt match');
        }
    }
    window.location.reload();
}
</script>