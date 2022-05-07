<?php
$servername = "localhost"; //this is default dont change this if using xampp
$username = "enwee"; //your database username
$password = "4y4mm@rchel"; //your database password
$dbname =  "glory"; //database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

function query($sql)
{
    // using variable that already avaiable on this file "outside the function".
    global $conn;

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
    }
    $row = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
?>