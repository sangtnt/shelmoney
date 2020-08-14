<?php
    session_start();
    require "./userModel.php";
    addBalance($_POST["amount"], $_POST["note"]);
    header("location: index.php");
?>