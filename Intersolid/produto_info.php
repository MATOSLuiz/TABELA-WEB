<?php
require_once("../conexaomysql.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    // $query_produtos_old = "SELECT DISTINCT p.NOME, f.nome_fantasia as fornecedor, m.MODULO, m.VALOR, m.produto_id from tab_produto p 
    // inner join tab_fornecedor as f on FORNECEDOR_ID = f.id
    // inner join tab_modulo as m on m.produto_id = $id group by MODULO";

    // $result_produto = $conexao->prepare($query_produtos);
    // $result_produto->execute();

    // $row_produto = $result_produto->fetchAll();

    $query_produtos = "SELECT p.*, f.NOME_FANTASIA as fornecedor from tab_produto p 
        inner join tab_fornecedor as f on FORNECEDOR_ID = f.id
        WHERE p.id = $id";

    $result_produto = $conexao->prepare($query_produtos);

    $result_produto->execute();
    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);

    $query_modulos = "SELECT * from tab_modulo where produto_id = " . $id;
    $result_modulo = $conexao->prepare($query_modulos);

    $result_modulo->execute();
    $row_modulo = $result_modulo->fetchAll();

    $retorna = ['erro' => false, 'produto' => $row_produto, 'modulos' => $row_modulo];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'>
            Erro: Nenhum Produto Encontrado!
        </div>"];
}

echo json_encode($retorna);
