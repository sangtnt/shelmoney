<?php
    session_start();
    require "./userModel.php";
    deleteDebtor($_GET["id"], $_GET["amount"]);
    header("location:viewDebtor.php");
?>