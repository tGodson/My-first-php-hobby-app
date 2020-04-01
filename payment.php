<?php session_start();
    if(isset($_SESSION['id'])){
        die('payment page');
    }else{
        Header('Location: login.php');
    }

?>