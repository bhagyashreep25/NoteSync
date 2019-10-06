<?php
session_start();
require_once('./config.php');
if(!isset($_SESSION['userid'])){
    header("Location:./signup.php");
}

$query = "SELECT user.piclink,"

?>