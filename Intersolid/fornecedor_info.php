<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_fornecedores = "SELECT * from TAB_FORNECEDOR WHERE id = :id LIMIT 1";
    $result_fornecedor = $conexao->prepare($query_fornecedores);
    $result_fornecedor->bindParam(':id', $id);
    $result_fornecedor->execute();

    $row_fornecedor = $result_fornecedor->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_fornecedor];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhum Fornecedor Encontrado!
        </div>"];
}

echo json_encode($retorna);
