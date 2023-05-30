<?php

$host="localhost";
$user="root";
$pass="";
$dbname="eurom";
$port="3306";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;port=$port;";
    $pdo = new PDO($dsn, $user, $pass);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $err) {
    echo 'Error: ' . $err->getMessage();
}

?>