<?php
require_once("../conexaomysql.php");
?>
<?php

$query_revendas = "SELECT id, RAZAO_SOCIAL,NOME_FANTASIA from TAB_REVENDA";
$result_revendas = $conexao->prepare($query_revendas);
$result_revendas->execute();

$dados = "";

while ($row_revenda = $result_revendas->fetch(PDO::FETCH_ASSOC)) {
    extract($row_revenda);
    $dados .= "<table><tr><td>$id</td><td>$RAZAO_SOCIAL</td><td>$NOME_FANTASIA</td><td class='d-flex justify-content-end'><button id='$id' class='btn btn-outline-primary btn-sm' onclick='visRevenda($id)'>Informações</button><button id='$id' class='btn btn-outline-warning btn-sm ms-2' onclick='editRevenda($id)'>Editar</button><button id='$id' class='btn btn-outline-danger btn-sm ms-2' onclick='deleteRevenda($id)'>Apagar</button></td></tr></table>";
}

echo $dados;