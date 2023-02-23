<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_clientes = "DELETE from TAB_CLIENTE WHERE id=:id";
    $Cliente = $conexao->prepare($query_clientes);
    $Cliente->bindParam(':id', $id);

    if ($Cliente->execute()) {
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>
            Cliente apagado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Falha ao apagar Cliente!</div>"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhum Cliente Encontrado!</div>"];
}

echo json_encode($retorna);
