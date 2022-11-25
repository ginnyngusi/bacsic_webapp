<?php

$servername = 'mysql-server';
$username= 'phpmyadmin';
$password = 'qwerty';
$databasename ='week2';

// $conn = new PDO('mysql:host=localhost;dbname=week2', 'phpmyadmin', 'qwerty');
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// global $conn;

$connect = mysqli_connect($servername, $username, $password, $databasename);

if($connect)
{
    // echo "Connection Successful";
}
else
{
    echo "Something went wrong!!";
    die(mysqli_error($connect));
}

global $connect;

?>