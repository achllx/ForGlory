<?php
    session_start();

    include "func.php";
    $un = $_SESSION['username'];
    $pw = $_SESSION['password'];



    $sql = "SELECT * FROM account WHERE un ='$un' AND pw = '$pw'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $newpw = $_GET['a'];
        $sql1 = "UPDATE account SET pw = '$newpw' WHERE un = '$un' AND pw = '$pw'";
        if($result1 = $conn->query($sql1)){
            echo "Success";
        }
    }
    else{
        echo "Error";
    }

    $conn->close();
?>