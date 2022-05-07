<?php
error_reporting(0);
require 'func.php';
session_start();

$un = $_SESSION['username'];
$pw = $_SESSION['password'];

$chara = query("SELECT * FROM chara LEFT JOIN account ON chara.accid = account.id WHERE  account.un = '$un' and account.pw = '$pw'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/charSelection.css">
    <link rel="stylesheet" href="../css/popUp.css">
    <!-- <script src="../js/CharSelection.js"></script> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FORGLORY: Character Select</title>
</head>

<body>
    <div class="col col-1" id="container" style=" background-color: #330411bb; height: 60%; width: 47%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1;">
        <table cellpadding="10" cellspacing="0" style="color: white; margin: 10px; overflow-y:scroll; height: 400px; display:block;">
            <tr border="1" style="top:0px; position:sticky; background-color:#330411;">
                <th>No</th>
                <th>Char</th>
                <th>Job</th>
                <th>Health</th>
                <th>Mana</th>
                <th>Atk</th>
                <th>Matk</th>
                <th>Gold</th>
                <th></th>
                <th></th>


            </tr>
            <?php $i = 1; ?>
            <?php foreach ($chara as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><img src="../asset/char/<?= $row['img']; ?>" alt="charPic" style="width: 100px; height:100px;"></td>
                    <td><?= $row['job']; ?></td>
                    <td><?= $row['health']; ?></td>
                    <td><?= $row['mana']; ?></td>
                    <td><?= $row['atk']; ?></td>
                    <td><?= $row['matk']; ?></td>
                    <td><?= $row['gold'] ?>G</td>
                    <td><a href="delchar.php?id=<?=$row['charid']?>" style="color: red;">Delete</a></td>
                    <td><a href="main.php?charid=<?= $row['charid'] ?>" style="color:chartreuse">Play</a></td>
                </tr>
                <?php $i++ ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><button onclick="addNew()">Add</button></td>
            </tr>
        </table>
    </div>

    <div id="create" class="modal">
        <div class="modal-content">
            <div style="text-align: center">Add New Character</div>
            <br />
            <label for="job">Choose a Job:</label>
            <select id="job" name="job">
                <option value="Knight">Knight</option>
                <option value="Assassin">Assassin</option>
                <option value="Wizard">Wizard</option>
                <option value="Shaman">Shaman</option>
            </select>
            <br />
            <div onclick="createChar()" style="
                margin: 5px 0 5px 0;
                width: 70px;
                height: 25px;
                text-align: center;
                background-color: white;
                 color: rgb(113, 8, 26);
                border: solid 1px #8a91c0;
                cursor: pointer;
              ">
                Create
            </div>
            <div id="result" style="
                color: black;
                border: 1px solid white;
                height: 20px;
                background-color: white;
              "></div>
            <div id="back" onclick="back()" style="
                margin-top: 5px;
                width: 50px;
                text-align: center;
                background-color: white;
                 color: rgb(113, 8, 26);
                border: solid 1px #8a91c0;
                cursor: pointer;
              ">
                Back
            </div>
        </div>
    </div>
    <div id="delchar" class="modal">
        <div class="modal-content">
            <div id="note" style="float: left;">Type CONFIRM to Delete your Character</div>
            <input id="dctype" type="text">
            <input type="submit" value="DELETE" onclick="delchar()">
            <div style="margin-top: 10px;">NOTE: Your account will delete forever!</div>
            <div id="back" onclick="back()" style="margin-top: 5px; width: 50px; text-align: center; background-color: white; color: #2d4875; border: solid 1px #8a91c0; cursor: pointer;">Back</div>
        </div>
    </div>

    <script>
        function addNew() {
            var x = document.getElementById("create");
            x.style.display = "block";
        }

        function back() {
            var x = document.getElementById("create");
            x.style.display = "none";
            document.getElementById("Email1").value = "";
            document.getElementById("result").innerHTML = "";
        }

        function createChar() {
            var select = document.getElementById('job');
            var value = select.options[select.selectedIndex].value;
            var a = document.getElementById('result');
            var x = new XMLHttpRequest();
            x.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) {
                        window.open("charselection.php", "_self");
                    } else {
                        a.innerHTML = this.responseText;
                    }
                }
            };
            x.open("GET", "createchar.php?job=" + value, true);
            x.send();
        }
    </script>
</body>

</html>