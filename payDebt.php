<?php
    session_start();
    require "./userModel.php";
    editAmountDebtor($_POST["id"],$_POST["amount"]);
    header("location:viewDebtor.php");
?>