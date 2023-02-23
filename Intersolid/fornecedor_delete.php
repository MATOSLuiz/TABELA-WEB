<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_fornecedores = "DELETE from TAB_FORNECEDOR WHERE id=:id";
    $result_fornecedor = $conexao->prepare($query_fornecedores);
    $result_fornecedor->bindParam(':id', $id);

    if ($result_fornecedor->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>
            Fornecedor Apagado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Falha ao apagar usuário!</div>"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhum Fornecedor Encontrado!</div>"];
}

echo json_encode($retorna);
