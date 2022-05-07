<?php
    require 'func.php';
    session_start();
 $charid = $_SESSION['charid'];
    $sql = "SELECT * FROM chara WHERE charid = '$charid' ";
    $result = $conn -> query($sql);
    if($result->num_rows>0){
        while($data = mysqli_fetch_array($result)){
            $revita = $data['revita'];
            $remagic = $data['remagic'];
            $gold = $data['gold'];
        }
        mysqli_free_result($result);
    }else{
        echo "ERROR";
    }

    $addRev = (int)$_GET['addRev'];
    $addRem = (int)$_GET['addRem'];

    $updateGold = ($addRem+$addRev) * 50;


    $newRev= $revita + $addRev;
    $newRem= $remagic + $addRem;
    $newGold= $gold - $updateGold;
    if($gold<0){
        echo "No Enought Gold";
    }else{
         $sql1 = "UPDATE chara SET revita = '$newRev', remagic = '$newRem', gold = '$newGold' WHERE charid = '$charid'";
        if($result1 = $conn->query($sql1)){
            echo "Success";
            // echo $newRev." ".$newRem." ".$newGold;
        }else{
            echo "error";
        }
    }
    // echo $revita." ".$remagic." ".$gold;
    // echo $newRev." ".$newRem." ".$newGold;
