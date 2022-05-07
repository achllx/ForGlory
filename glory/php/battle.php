<?php
    require 'func.php';
    session_start();
    $charid = $_SESSION['charid'];

    if(isset($_GET['basic'])){

        $Php = $_GET['Php'];
        $Ehp = $_GET['Ehp'];
        $Pdmg = $_GET['Pdmg'];
        $Edmg = $_GET['Edmg'];
        $Ename = $_GET['Ename'];
        $Kill = $_GET['Kill'];

        if($Php == 0){
            mysqli_query($conn, "DELETE FROM chara WHERE charid = '$charid'");
            mysqli_query($conn, "UPDATE current SET health = '$Ehp' WHERE currentId = '1'");
            echo "GameOver";
        }elseif($Ehp == 0){
            mysqli_query($conn, "UPDATE chara SET health = '$Php', gold = '$Kill' WHERE charid = '$charid'");
            mysqli_query($conn, "DELETE FROM current WHERE currentId = '1'");

            $newId = rand(1,5);
            $sql = "SELECT * FROM monster WHERE monsId = '$newId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $name = $data['ename'];
                    $hp = $data['health'];
                    $mp = $data['mana'];
                    $atk = $data['atk'];
                    $matk = $data['matk'];
                    $def = $data['def'];
                    $mdef = $data['mdef'];
                    $gold = $data['gold'];
                    $w = $data['width'];
                    $h = $data['height'];
                    $img = $data['img'];
                }
                mysqli_free_result($result);
                } else {
                    echo "ERROR";
                }
                mysqli_query($conn, "INSERT INTO current (currentid, ename, health, mana, atk, matk, def, mdef, gold, width, height, img)
                                                            VALUES('1' ,'$name', '$hp', '$mp', '$atk', '$matk', '$def', '$mdef', '$gold', '$w', '$h', '$img')");

                echo "Enemy Defeat";
            }else{
            mysqli_query($conn, "UPDATE chara SET health = '$Php' WHERE charid = '$charid'");
            mysqli_query($conn, "UPDATE current SET health = '$Ehp' WHERE currentId = '1'");
            echo "You dealt ".$Pdmg." physical damage.\n".$Ename." dealt ".$Edmg." physical damage.";
        }

        // $sql = "UPDATE chara SET health = '$Php' WHERE charid = '$charid'";
        // $sql1 = "UPDATE current SET health = '$Ehp' WHERE currentId = '1'";
    }
    if(isset($_GET['skill'])){
        $Php = $_GET['Php'];
        $Ehp = $_GET['Ehp'];
        $Pdmg = $_GET['Pdmg'];
        $Edmg = $_GET['Edmg'];
        $Pmp = $_GET['Pmp'];
        $Emp = $_GET['Emp'];
        $Ename = $_GET['Ename'];
        $Kill = $_GET['Kill'];

        if ($Php == 0) {
            mysqli_query($conn, "DELETE FROM chara WHERE charid = '$charid'");
            mysqli_query($conn, "UPDATE current SET health = '$Ehp', mana = '$Emp' WHERE currentId = '1'");
            echo "GameOver";
        } elseif ($Ehp == 0) {
            mysqli_query($conn, "UPDATE chara SET health = '$Php', mana = '$Pmp', gold = '$Kill' WHERE charid = '$charid'");
            mysqli_query($conn, "DELETE FROM current WHERE currentId = '1'");

            $newId = rand(1, 5);
            $sql = "SELECT * FROM monster WHERE monsId = '$newId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $name = $data['ename'];
                    $hp = $data['health'];
                    $mp = $data['mana'];
                    $atk = $data['atk'];
                    $matk = $data['matk'];
                    $def = $data['def'];
                    $mdef = $data['mdef'];
                    $gold = $data['gold'];
                    $w = $data['width'];
                    $h = $data['height'];
                    $img = $data['img'];
                }
                mysqli_free_result($result);
            } else {
                echo "ERROR";
            }
            mysqli_query($conn, "INSERT INTO current (currentid, ename, health, mana, atk, matk, def, mdef, gold, width, height, img)
                                                                VALUES('1' ,'$name', '$hp', '$mp', '$atk', '$matk', '$def', '$mdef', '$gold', '$w', '$h', '$img')");

            echo "Enemy Defeat";
        } else {
            mysqli_query($conn, "UPDATE chara SET health = '$Php', mana = '$Pmp' WHERE charid = '$charid'");
            mysqli_query($conn, "UPDATE current SET health = '$Ehp', mana = '$Emp' WHERE currentId = '1'");
            echo "You dealt " . $Pdmg . " magical damage.\n" . $Ename . " dealt " . $Edmg . " magical damage.";
        }
    }
    if(isset($_GET['revita'])){
        $Php = $_GET['Php'];
        $revita = $_GET['revita'];

        mysqli_query($conn, "UPDATE chara SET health = '$Php', revita = '$revita' WHERE charid = '$charid'");
        echo "Consume 1 revita\nRegen 200 HP\n".$revita." revita left";
    }
    if(isset($_GET['remagic'])){
    $Pmp = $_GET['Pmp'];
    $remagic = $_GET['remagic'];

    mysqli_query($conn, "UPDATE chara SET mana = '$Pmp', remagic = '$remagic' WHERE charid = '$charid'");
    echo "Consume 1 remagic\nRegen 100 MP\n" . $remagic . " remagic left";
    }
?>