<?php
    session_start();
    include 'func.php';
    $un = $_SESSION['username'];
    $pw = $_SESSION['password'];

    $type = $_GET['a'];

    $sql = "DELETE FROM account WHERE un = '$un' AND pw = '$pw'";

    if($type == "CONFIRM"){
        if($result = $conn->query($sql)){
            echo "Success";
        }
    }
    else{
        echo "!! You must type CONFIRM to DELETE ACCOUNT!!";
    }

    $conn->close();
