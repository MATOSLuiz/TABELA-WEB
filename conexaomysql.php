<?php 
$usuario = '';
$senha = '';
$database = '';
$host = '';

$con = new mysqli($host, $usuario, $senha, $database);

if($con->error) {
    die("Falha na conexão com o banco de dados! " . $con->error);
}


$hostPDO = "localhost";
$userPDO = "root";
$databasePDO = "painelweb";
$password = "lu1z";

try {
    $conexao = new PDO("mysql:host=$hostPDO;dbname=" . $databasePDO,$userPDO,$password);
} catch (PDOException $err) {
    echo "Erro: Conexão com banco de dados Falhou! Erro gerado". $err->getMessage();
}