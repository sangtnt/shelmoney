<?php
    session_start();
    require "./userModel.php";
    addSpending($_POST["amount"], $_POST["note"]);
    header("location: index.php");
?>