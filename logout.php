<script>
function logout(){
  
  var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
   console.log(this.responseText);
   window.localStorage.removeItem('cart');
   window.localStorage.removeItem('quantity');
   window.localStorage.removeItem('qty');
   <?php //Header('Location: login.php'); ?>
   
  }
};
//var cart = localStorage.getItem('cart');
xhttp.open("GET", "logoutAjax.php", true);
xhttp.send();

}
</script>

