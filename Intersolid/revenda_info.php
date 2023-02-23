<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_revendas = "SELECT * from TAB_REVENDA WHERE id = :id LIMIT 1";
    $result_revenda = $conexao->prepare($query_revendas);
    $result_revenda->bindParam(':id', $id);
    $result_revenda->execute();

    $row_revenda = $result_revenda->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_revenda];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhuma Revenda Encontrada!
        </div>"];
}

echo json_encode($retorna);
