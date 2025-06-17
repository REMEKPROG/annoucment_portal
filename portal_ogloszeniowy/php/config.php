<?php

//initializing pdo connection

$type = "mysql";
$server = "localhost";
$dataBase = "serwis_ogloszeniowy";
$port = "3306";
$charset = "utf8mb4";

$dsn = "$type:host=$server;dbname=$dataBase;port=$port;charset=$charset";

$login = "root";
$pass = "";

$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
$pdo = new PDO($dsn, $login, $pass, $options);
} catch(PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}



?>