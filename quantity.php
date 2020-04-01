<script>
function quantityChange(id){

var qty=[];
qty.push(id,JSON.parse(document.getElementById(id).value));
var cart=JSON.parse(localStorage.getItem('cart'));
for(var i=0;i<cart.length;i++){
    if(cart[i].productID==id){
        
        cart[i].quantity=document.getElementById(id).value;
        break;
    }
}

    localStorage.setItem('cart',JSON.stringify(cart));
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "quantityAjax.php?quantityArr="+qty, true);
    xhttp.send();
    window.location.reload();
}
</script>  