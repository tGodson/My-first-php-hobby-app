<?php
    session_start();
    $session_cleared = false;
    if( session_destroy()){
        $session_cleared = true;
        //Header('Location: login.php');
    } 
    echo json_encode(array('result'=>$session_cleared));
   
?>
