<?php
    session_start();
    require "./userModel.php";
    addDebtor($_POST["name"], $_POST["amount"]);
    header("location: index.php");
?>