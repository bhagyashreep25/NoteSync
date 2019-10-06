<?php
    $host = "remotemysql.com";
    $dbname = "KmKGFtQV92";
    $username = "KmKGFtQV92";
    $password = "NZA2ltEC9k";
    $port="3306";
    try{
        $conn = mysqli_connect($host,$username,$password,$dbname,$port);
        if(!mysqli_connect_errno()){
            echo "Connected!";
            
        }

    }catch(Exception $e){
        echo $e . ":(";
        exit;
    }

    $uploadpath = "./uploads/";
    $resultpath = "./results/";
    // print_r($conn);
?>

