<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_clientes = "SELECT * from TAB_CLIENTE WHERE id = :id LIMIT 1";
    $result_cliente = $conexao->prepare($query_clientes);
    $result_cliente->bindParam(':id', $id);
    $result_cliente->execute();

    $row_cliente = $result_cliente->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_cliente];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhum Cliente Encontrado!
        </div>"];
}

echo json_encode($retorna);
