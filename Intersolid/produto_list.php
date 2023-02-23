<?php
require_once("../conexaomysql.php");
?>
<?php

$query_produtos = "SELECT p.id,p.NOME,p.VALOR_TABELA,p.VALOR_MINIMO,p.VALOR_IMPLANTACAO, f.NOME_FANTASIA AS fornecedor from tab_produto as p
INNER JOIN tab_fornecedor as f on p.FORNECEDOR_ID = f.id";
$result_produtos = $conexao->prepare($query_produtos);
$result_produtos->execute();

$dados = "";

while ($row_produto = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    extract($row_produto);
    $dados .= "<table><tr><td>$id</td><td>$NOME</td><td>$fornecedor</td><td>R$ $VALOR_TABELA</td><td>R$ $VALOR_MINIMO</td><td>R$ $VALOR_IMPLANTACAO</td><td class='d-flex justify-content-end'><button id='$id' class='btn btn-outline-primary btn-sm' onclick='visProduto($id)'>Informações</button><button id='$id' class='btn btn-outline-warning btn-sm ms-2' onclick='editProduto($id)'>Editar</button><button id='$id' class='btn btn-outline-danger btn-sm ms-2' onclick='deleteProduto($id)'>Apagar</button></td></tr></table>";
}

echo $dados;

?>
