<?php
    session_start();
    require "./connectDatabase.php";
    if(isset($_COOKIE["user"])){
        $user = base64_decode($_COOKIE["user"]);
        $sql = "SELECT * FROM user WHERE id = '$user'";
        $result = $conn->query($sql);
        if ($result->num_rows==0){
            header("location:login.php");
        }
        else{
            while($row = $result->fetch_assoc()) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["user"] = $row["username"];
                $_SESSION["fullname"] = $row["fullname"];
            }
        }
    }
    else{
        header("location:login.php");
    }
?>