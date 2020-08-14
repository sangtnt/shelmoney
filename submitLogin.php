<?php
    require "./userModel.php";
    require "./entity/user.php";
    $user = new User();
    $user->username=$_POST["username"];
    $user->password=$_POST["password"];
    $r =check($user);
    if($r != ''){
        setcookie("user", base64_encode(strval($r)), time() + (9999 * 9999), "/");
        header("location:index.php");
    }
    else{
        header("location:login.php");
    }
?>