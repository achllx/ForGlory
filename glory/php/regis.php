<?php
    include "func.php";

    $un=$_GET['un'];
    $pw=$_GET['pw'];
    $email=$_GET['email'];

    if($email == "" || $email == null){
        echo "Email Cannot be Empty";
    }
    elseif((strlen($un)>=4 && strlen($un)<=12) && (strlen($pw)>=4 && strlen($pw)<=12)){
        // make query
        $email_check = "SELECT email FROM account WHERE email='$email'";
        $username_check = "SELECT un FROM account WHERE un='$un'";
        // inserting query
        $result = $conn->query($email_check);
        $result1 = $conn->query($username_check);
        $sql = "INSERT INTO account (email, un, pw)
                VALUES ('$email', '$un', '$pw')";
        // checking
        if($result->num_rows > 0){
            echo 'Email Already Exist';
            echo "<br>";
        }
        elseif($result1->num_rows > 0){
            echo 'Username Alreasy Exist';
        }
        else{
            mysqli_query($conn,$sql);
            echo "1";
        }
        $conn->close();
    }
    elseif((strlen($un)<4 || strlen($un)>12) && (strlen($pw)>=4 && strlen($pw)<=12)){
        echo "Username must be 4 letters and maximum 12 letters";
    }
    elseif((strlen($pw)<4 || strlen($pw)>12) && (strlen($un)>=4 && strlen($un)<=12)){
        echo "Password must contain 8 char and maximum 20 char";
    }
    else{
        echo "error";
    }
