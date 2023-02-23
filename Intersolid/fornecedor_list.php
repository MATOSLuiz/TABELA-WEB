<?php
require_once("../conexaomysql.php");
?>
<?php

$query_fornecedores = "SELECT id, RAZAO_SOCIAL,NOME_FANTASIA from TAB_FORNECEDOR";
$result_fornecedores = $conexao->prepare($query_fornecedores);
$result_fornecedores->execute();

$dados = "";

while ($row_fornecedor = $result_fornecedores->fetch(PDO::FETCH_ASSOC)) {
    extract($row_fornecedor);
    $dados .= "<table><tr><td>$id</td><td>$RAZAO_SOCIAL</td><td>$NOME_FANTASIA</td><td class='d-flex justify-content-end'><button id='$id' class='btn btn-outline-primary btn-sm' onclick='visFornecedor($id)'>Informações</button><button id='$id' class='btn btn-outline-warning btn-sm ms-2' onclick='editFornecedor($id)'>Editar</button><button id='$id' class='btn btn-outline-danger btn-sm ms-2' onclick='deleteFornecedor($id)'>Apagar</button></td></tr></table>";
}

echo $dados;

?>

