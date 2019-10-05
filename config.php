<?php
    $host = "remotemysql.com";
    $dbname = "KmKGFtQV92";
    $username = "KmKGFtQV92";
    $password = "NZA2ltEC9k";
    $port="3306";
    try{
        // $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");
        $conn = mysqli_connect($host,$username,$password,$dbname,$port);
        if(!mysqli_connect_errno()){
            echo "Connected!";
            // $result = mysqli_query($conn,"SELECT * FROM `KmKGFtQV92`.`user`;");
            // echo $result;
            // if(mysqli_num_rows($result)>0){
                // echo "yayyyyyyyyyy";
            // }
        }

    }catch(Exception $e){
        echo $e . ":(";
        exit;
    }

    $uploadpath = "./uploads/";
    $resultpath = "./results/";
    // print_r($conn);
?>

