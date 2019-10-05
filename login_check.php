<?php
session_start();
require_once('./config.php');
$email = "";
$pwd = "";
if (isset($_POST['log_email'])) {
    $email = $_POST['log_email'];
    $pwd = $_POST['log_password'];
    // echo "$email $pwd";
    // echo "hello";
    try {
        print_r($conn);
        echo "$email $pwd";
        $query = "SELECT user.email, user.password, user.id from $dbname.user as user where email='" . $email . "';";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_pwd = $row['password'];
            $_SESSION['userid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
        }
    } catch (Exception $e) {
        echo "Failed";
    }
    // echo "$db_pwd";
    // echo "$email $pwd";
    // if ($pwd == $db_pwd) {
        // echo "WOOOOOOOOOOO";
        // session_start();
        // $_SESSION['loggedIn'] = true;
        // $_SESSION['userid'] = $member_id;
        // $_SESSION['username'] = $email;
    if(password_verify($pwd,$db_pwd)){
        header("Location:./index.php");
    } else {
        header("Location:./signup.php");
    }
} else if (isset($_POST['reg_email'])) {
    // echo "inside reg";
    $email = $_POST['reg_email'];
    $pwd = $_POST['reg_password'];
    // $phone = $_POST['phone'];
    // $name = $_POST['name'];
    try {
        print_r($conn);
        // echo "$email $pwd";
        $options = array("cost" => 4);
        $hashPassword = password_hash($pwd, PASSWORD_BCRYPT, $options);
        $query = "INSERT INTO $dbname.user(email,password) VALUES ($email', '$hashPassword');";
        $result = mysqli_query($conn, $query);
        // $db_pwd = pg_fetch_result($result,0,1);
        if ($result) {
            $query = "SELECT user.id from $dbname.user where email='" . $email . "';";
            $result = mysqli_query($conn, $query);
            $member_id = mysqli_fetch_assoc($result);
            // $_SESSION['loggedIn'] = true;
            $_SESSION['userid'] = $member_id['id'];
            header("Location:./index.php");
        } else {
            header("Location:./signup.php");
        }
    } catch (Exception $e) {
        echo "Failed";
    }
} else {
    //illegal access, redirect to index
    header("Location:" . $codepath . "index.php");
}
