<?php
require 'func.php';
session_start();

$job = $_GET['job'];
$un = $_SESSION['username'];
$pw = $_SESSION['password'];

$sql1 = "SELECT id FROM account WHERE un='$un' AND pw='$pw'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    while ($data = mysqli_fetch_array($result1)) {
        $id = $data['id'];
    }
    mysqli_free_result($result1);
}

$id = $id;
$img = strtolower($job).".gif";
$potion = 10;
$revita = 10;
$remagic = 10;
$gold = 500;

if ($job == "Knight"){
    $hp=10000;
    $mp=3000;
    $atk=50;
    $matk=20;
    $def=10;
    $mdef=10;
}
elseif ($job == "Assassin"){
    $hp=5000;
    $mp=5000;
    $atk=70;
    $matk=30;
    $def=10;
    $mdef=30;
}
elseif ($job == "Shaman"){
    $hp=8000;
    $mp=5000;
    $atk=50;
    $matk=50;
    $def=20;
    $mdef=20;
}
elseif ($job == "Wizard"){
    $hp=5000;
    $mp=10000;
    $atk=50;
    $matk=80;
    $def=10;
    $mdef=30;
}


$sql = "INSERT INTO chara (accid, job, health, mana, atk, matk, def, mdef, potion, revita, remagic, gold, img)
        VALUES ('$id', '$job', '$hp', '$mp', '$atk', '$matk', '$def', '$mdef', '$potion', '$revita', '$remagic', '$gold', '$img')";
$result = $conn->query($sql);
if ($result > 0) {
    echo "1";
} else {
    echo "Error";
}
$conn->close();
