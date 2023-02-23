<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_produtos = "DELETE from TAB_PRODUTO WHERE id=:id";
    $result_produto = $conexao->prepare($query_produtos);
    $result_produto->bindParam(':id', $id);

    if ($result_produto->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>
            Produto Apagado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Falha ao apagar Produto!</div>"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhum Produto Encontrado!</div>"];
}

echo json_encode($retorna);
