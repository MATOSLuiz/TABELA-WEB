<?php
require_once("../conexaomysql.php");
?>
<?php

$query_clientes = "SELECT id, RAZAO_SOCIAL,NOME_FANTASIA from TAB_CLIENTE";
$result_clientes = $conexao->prepare($query_clientes);
$result_clientes->execute();

$dados = "";

while ($row_cliente = $result_clientes->fetch(PDO::FETCH_ASSOC)) {
    extract($row_cliente);
    $dados .= "<table><tr><td>$id</td><td>$RAZAO_SOCIAL</td><td>$NOME_FANTASIA</td><td class='d-flex justify-content-end'><button id='$id' class='btn btn-outline-primary btn-sm' onclick='visCliente($id)'>Informações</button><button id='$id' class='btn btn-outline-warning btn-sm ms-2' onclick='editCliente($id)'>Editar</button><button id='$id' class='btn btn-outline-danger btn-sm ms-2' onclick='deleteCliente($id)'>Apagar</button></td></tr></table>";
}

echo $dados;

?>

