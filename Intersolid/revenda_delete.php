<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_revendas = "DELETE from TAB_Revenda WHERE id=:id";
    $revenda = $conexao->prepare($query_revendas);
    $revenda->bindParam(':id', $id);

    if ($revenda->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>
            Revenda Apagada com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Falha ao apagar Revenda!</div>"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhuma Revenda Encontrado!</div>"];
}

echo json_encode($retorna);
