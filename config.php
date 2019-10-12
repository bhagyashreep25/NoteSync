<?php
    require_once('./keys.php');

    try{
        $conn = mysqli_connect($host,$username,$password,$dbname,$port);
        if(!mysqli_connect_errno()){
            // echo "Connected!";
            
        }

    }catch(Exception $e){
        echo $e . ":(";
        exit;
    }

    
    $uploadpath = "./uploads/";
    $resultpath = "./results/";
    // print_r($conn);
?>

