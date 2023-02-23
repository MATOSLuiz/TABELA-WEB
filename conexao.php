<?php

define('DB_HOST', "");
define('DB_USER', "");
define('DB_PASSWORD', "");
define('DB_NAME', "");
define('DB_DRIVER', "sqlsrv");

//Configurações para conexão com PDO
$pdoConfig  = DB_DRIVER . ":" . "Server=" . DB_HOST . ";";
$pdoConfig .= "Database=" . DB_NAME . ";";

try {
    if (!isset($conn)) {
        $conn =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $conn;
} catch (PDOException $e) {
    $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
    $mensagem .= "\nErro: " . $e->getMessage();
    throw new Exception($mensagem);
}
