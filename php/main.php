<?php
require 'func.php';
session_start();

$un = $_SESSION['username'];
$pw = $_SESSION['password'];
$charid = $_GET['charid'];
$_SESSION['charid'] = $charid;

$char = query("SELECT * FROM chara WHERE charid = '$charid'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/popUp.css">
    <title>FORGLORY: TurnBaseBattle</title>
</head>

<body>
    <div id="container">
        <div id="game">
            <?php $i = 1; ?>
            <?php foreach ($char as $row) : ?>
                <div id="profilepicture" style="float: left; margin-top: 260px; margin-left: 150px; width:100px; height:100px;"><img src='../asset/char/nobg/<?= $row['img']; ?>' width='100' height='100'></div>
                <?php $i++ ?>
            <?php endforeach; ?>
            <?php
            $sql = "SELECT * FROM current";
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
                echo 'error';
            }
            ?>
            <div id="enemypicture" style="margin-right: 200px; margin-top: 210px; width: 150px; height: 150px; float: right;"><img src='../asset/monster/<?= $img; ?>' width='<?= $w; ?>' height='<?= $h; ?>'></div>
        </div>
        <div id="stts">
            <div id="PName" style="text-align: center;"><?= $un; ?></div>
            <div id="player" style="font-size: 15px;">
                <?php $i = 1; ?>
                <?php foreach ($char as $row) : ?>
                    <div>HP:</div>
                    <div id='Php'><?= $row['health']; ?></div>
                    <div>MP:</div>
                    <div id='Pmp'><?= $row['mana']; ?></div>
                    <div>Revita</div>
                    <div id='Rev'><?= $row['revita']; ?></div>
                    <div>Remagic</div>
                    <div id='Rem'><?= $row['remagic']; ?></div>
                    <div>Gold:</div>
                    <div id='Pgold'><?= $row['gold']; ?></div>

                    <div id='Patk' style="display: none;"><?= $row['atk']; ?></div>
                    <div id='Pmatk' style="display: none;"><?= $row['matk']; ?></div>
                    <div id='Pdef' style="display: none;"><?= $row['def']; ?></div>
                    <div id='Pmdef' style="display: none;"><?= $row['mdef']; ?></div>
                    <div id="charid" style="display: none;"><?= $row['charid']; ?></div>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </div>
            <div id="EName" style="text-align: center;"><?= $name; ?></div>
            <div id="enemy" style="font-size: 15px;">
                <div>HP:</div>
                <div id='Ehp'><?= $hp; ?></div>
                <div>MP:</div>
                <div id='Emp'><?= $mp; ?></div>
                <div>Attack Power:</div>
                <div id='Eatk'><?= $atk; ?></div>
                <div>Magic Attack Power:</div>
                <div id='Ematk'><?= $matk; ?></div>
                <div>Gold:</div>
                <div id='Egold'><?= $gold; ?></div>

                <div id='Edef' style="display: none;"><?= $def; ?></div>
                <div id='Emdef' style="display: none;"><?= $mdef; ?></div>
            </div>
        </div>
        <div id="menu">
            <div id="profile" class="button" style="margin-top: 15px; height: 25px; width: 100px;" onclick="shopModal()">Shop</div>
            <div id="changepw" class="button" style="margin-top:15px; height: 25px; width: 200px;" onclick="changepassmodal()">Change Password</div>
            <div id="deleteacc" class="button" style="margin-top: 15px; height: 25; width: 200px;" onclick="delAccModal()">Delete Account</div>
            <div id="exit" class="button" style="margin-top: 15px; height: 25px; width: 60px;" onclick="exitmodal()">Exit</div>
        </div>
        <div id="text">
            <div id="battle_message" style="color: white; border: 5px double black; height: 80px;background-color: rgba(0, 0, 0, 0.612);">NOTE: After You attack the enemy with basic attack or skill the enemy will attack you Back!</div>
            <div style="display: flex;">
                <div id="basic" style="width: 150px; padding-top: 5px;border-radius: 5px;text-align: center;margin: auto;background-color: white;color: black;border: solid 1px #8a91c0;cursor: pointer; margin-top: 10px;" onclick="basic()" data-value="basic">Basic Attack</div>
                <div id="useRev" style="width: 150px; padding-top: 5px;border-radius: 5px;text-align: center;margin: auto;background-color: white;color: black;border: solid 1px #8a91c0;cursor: pointer; margin-top: 5px;" onclick="revita()" data-value="revita">Use Revita</div>
            </div>
            <div style="display: flex;">
                <div id="skill" style="width: 150px; padding-top: 5px;border-radius: 5px;text-align: center;margin: auto;background-color: white;color: black;border: solid 1px #8a91c0;cursor: pointer; margin-top: 5px;" onclick="skill()" data-value="skill">Skill Attack</div>
                <div id="useRem" style="width: 150px; padding-top: 5px;border-radius: 5px;text-align: center;margin: auto;background-color: white;color: black;border: solid 1px #8a91c0;cursor: pointer; margin-top: 5px;" onclick="remagic()" data-value="remagic">Use Remagic</div>
            </div>
        </div>

    </div>
    </div>


    <!-- pop up -->
    <div id="shop" class="modal">
        <div class="modal-content">
            <div>Shop:</div>
            <br>
            <div><img src="../asset/item/revita.jpg" alt="revita" style="width: 50px; height:50px"></div>
            <label for="revita">Revita (50G each):</label>
            <input type="number" id="revita" name="revita" min="0" max="99" style="width: 35px;">
            <br>
            <div><img src="../asset/item/remagic.jpg" alt="remagic" style="width: 50px; height:50px"></div>
            <label for="remagic">Remagic (50G each):</label>
            <input type="number" id="remagic" name="remagic" min="0" max="99" style="width: 35px;">
            <br>
            <input type="submit" value="Buy" onclick="shop()">
            <div id="msg" style="background-color: white; width: 300px; height: 20px; margin:10px 0 10px 0"></div>
            <div id="back" onclick="back()" style=" margin-top: 5px; width: 50px; text-align: center; background-color: white; color: #2d4875; border: solid 1px #8a91c0; cursor: pointer;">Back</div>
        </div>
    </div>
    <div id="delAcc" class="modal">
        <div class="modal-content">
            <div id="note" style="float: left;">Type CONFIRM to Delete your Account</div>
            <input id="dctype" type="text">
            <input type="submit" value="DELETE" onclick="delAcc()">
            <div style="margin-top: 10px;">NOTE: Your account will delete forever!</div>
            <div id="back" onclick="back()" style="margin-top: 5px; width: 50px; text-align: center; background-color: white; color: #2d4875; border: solid 1px #8a91c0; cursor: pointer;">Back</div>
        </div>
    </div>
    <div id="changepass" class="modal">
        <div class="modal-content">
            <div style="float: left;">New Password:</div>
            <input id="cppassword" style=" font-family: serif;" type="text">
            <input type="submit" value="Change" onclick="changePass()">
            <div style="margin-top: 10px;">NOTE: You will direct back to login session after change password</div>
            <!-- <div  id="cpmessage" style="color: black; border: 1px solid white; height: 20px; background-color: white;"></div> -->
            <div id="back" onclick="back()" style="margin-top: 5px; width: 50px; text-align: center; background-color: white; color: #2d4875; border: solid 1px #8a91c0; cursor: pointer;">Back</div>
        </div>
    </div>
    <div id="exit1" class="modal">
        <div class="modal-content">
            <div style="text-align: center;">Are sure want to EXIT?</div>
            <div id="back" onclick="back()" style="float: right; margin-right: 80px; margin-top: 10px; width: 50px; text-align: center; background-color: white; color: #2d4875; border: solid 1px #8a91c0; cursor: pointer;">NO</div>
            <div onclick="exit()" style="margin-left: 80px; margin-top: 10px; width: 50px; text-align: center; background-color: white; color: #2d4875; border: solid 1px #8a91c0; cursor: pointer;">YES</div>
        </div>
    </div>

    <script>
        // player enemy component
        // player
        var Php = document.getElementById('Php').innerHTML;
        var Pmp = document.getElementById('Pmp').innerHTML;
        var Patk = document.getElementById('Patk').innerHTML;
        var Pmatk = document.getElementById('Pmatk').innerHTML;
        var Pdef = document.getElementById('Pdef').innerHTML;
        var Pmdef = document.getElementById('Pmdef').innerHTML;
        var rev = document.getElementById('Rev').innerHTML;
        var rem = document.getElementById('Rem').innerHTML;
        var Pgold = document.getElementById('Pgold').innerHTML;
        var charid = document.getElementById('charid').innerHTML;
        //enemy
        var Ename = document.getElementById('EName').innerHTML
        var Ehp = document.getElementById('Ehp').innerHTML;
        var Emp = document.getElementById('Emp').innerHTML;
        var Eatk = document.getElementById('Eatk').innerHTML;
        var Ematk = document.getElementById('Ematk').innerHTML;
        var Edef = document.getElementById('Edef').innerHTML;
        var Emdef = document.getElementById('Emdef').innerHTML;
        var Egold = document.getElementById('Egold').innerHTML;

        // popup
        function shopModal() {
            document.getElementById("shop").style.display = "block";
        }

        function changepassmodal() {
            document.getElementById("changepass").style.display = "block";
        }

        function delAccModal() {
            document.getElementById("delAcc").style.display = "block";
        }

        function exitmodal() {
            document.getElementById("exit1").style.display = "block";
        }

        function back() {
            document.getElementById("shop").style.display = "none";
            document.getElementById("delAcc").style.display = "none";
            document.getElementById("changepass").style.display = "none";
            document.getElementById("exit1").style.display = "none";
        }

        function exit() {
            window.open("../index.html", "_self")
        }
        // system
        function delAcc() {
            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "Success") {
                        window.open("../index.html", "_self");
                    } else {
                        document.getElementById("note").innerHTML = this.responseText;
                    }
                }
            };
            x.open("GET", "delAcc.php?a=" + dctype.value, true);
            x.send();
        }

        function changePass() {
            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "Success") {
                        document.getElementById("cppassword").value = "";
                        window.open("../index.html", "_self");
                    }
                }
            };
            x.open("GET", "changepw.php?a=" + cppassword.value, true);
            x.send();
        }

        function shop() {
            var revita = document.getElementById('revita').value;
            var remagic = document.getElementById('remagic').value;
            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "Success") {
                        window.open("main.php?charid=" + charid, "_self");
                    } else {
                        document.getElementById('msg').innerHTML = this.responseText;
                    }
                }
            };
            x.open("GET", "shop.php?addRev=" + revita + "&addRem=" + remagic, true);
            x.send();
        }

        function basic() {
            var Pdmg = Patk - Edef;
            var Edmg = Eatk - Pdef;
            var Kill = parseInt(Pgold) + parseInt(Egold);

            console.log(Kill);

            if (Pdmg < 1)
                Pdmg = 1;
            if (Edmg < 1)
                Edmg = 1;

            Php = Php - Edmg;
            Ehp = Ehp - Pdmg;

            // Php = -1;
            // Ehp = Ehp - Pdmg;

            if (Php < 0)
                Php = 0;
            if (Ehp < 0)
                Ehp = 0;

            console.log(Php);
            console.log(Ehp);

            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "GameOver") {
                        alert("You Death!!");
                        window.open("../index.html", "_self");
                    } else {
                        alert(this.responseText);
                        location.reload();
                    }
                }
            };
            x.open("GET", "battle.php?basic=1&Php=" + Php + "&Ehp=" + Ehp + "&Pdmg=" + Pdmg + "&Edmg=" + Edmg + "&Ename=" + Ename + "&Kill=" + Kill, true);
            x.send();
        }

        function skill() {
            var Pdmg = Pmatk - Emdef;
            var Edmg = Ematk - Pmdef;
            var minPmp = Pmp - 50;
            var minEmp = Emp - 50;
            var Kill = parseInt(Pgold) + parseInt(Egold);

            if (Pdmg < 1)
                Pdmg = 1;
            if (Edmg < 1)
                Edmg = 1;
            if (Pmp < 50) {
                minPmp = 0;
                Pdmg = 0;
            }
            if (Emp < 50) {
                minEmp = 0;
                Edmg = 0;
            }


            Php = Php - Edmg;
            Ehp = Ehp - Pdmg;

            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "GameOver") {
                        alert("You Death!!");
                        window.open("../index.html", "_self");
                    } else {
                        alert(this.responseText);
                        location.reload();
                    }
                }
            };
            x.open("GET", "battle.php?skill=1&Php=" + Php + "&Ehp=" + Ehp + "&Pmp=" + minPmp + "&Emp=" + minEmp + "&Pdmg=" + Pdmg + "&Edmg=" + Edmg + "&Ename=" + Ename + "&Kill=" + Kill, true);
            x.send();
        }

        function revita() {
            var hpRec = parseInt(Php) + 200;
            var minRev = rev - 1;

            if (minRev < 0)
                alert("No revita left in your bag");
            else {
                var x = new XMLHttpRequest();
                x.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        location.reload();
                    }
                };
                x.open("GET", "battle.php?revita=1&Php=" + hpRec + "&revita=" + minRev, true);
                x.send();
            }


        }

        function remagic() {
            var mpRec = parseInt(Pmp) + 100;
            var minRem = rem - 1;

            if (minRem < 0)
                alert("No remagic left in your bag");
            else {
                var x = new XMLHttpRequest();
                x.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        location.reload();
                    }
                };
                x.open("GET", "battle.php?remagic=1&Pmp=" + mpRec + "&remagic=" + minRem, true);
                x.send();
            }
        }
    </script>
</body>

</html>