<?php
require_once("./config.php");
session_start();
if(isset($_SESSION['userid'])){
    // unset($_SESSION['loggedIn']);
    unset($_SESSION['userid']);
    unset($_SESSION['email']);
    session_unset();
    // session_destroy();
    session_write_close();
 
}
// else{
    //redirect to login
    header("Location:./index.php");
    ob_flush();
// }
?>