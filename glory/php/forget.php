<?php

    include "func.php";

    $email=$_GET['email'];
    if($email != "" || $email != null){
        $sql = "SELECT * FROM account WHERE email='$email'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $data = mysqli_fetch_array($result);
            $password = $data['pw'];
            echo $password;
        }
    }
    else{
        echo "ERROR: Email NOt FOunD";
    }

    $conn->close();
