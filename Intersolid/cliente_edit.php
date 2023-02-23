<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$consulta = "SELECT * FROM TAB_CLIENTE WHERE CNPJ=:CNPJ AND id != :id";
$verifica_CNPJ = $conexao->prepare($consulta);
$verifica_CNPJ->bindParam(':CNPJ', $dados['CNPJ']);
$verifica_CNPJ->bindParam(':id', $dados['id']);
$verifica_CNPJ->execute();

if ($verifica_CNPJ->rowCount() > 0) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Cliente já cadastrado com esse CNPJ!</div>"];
} else {
    $query_clientes = "UPDATE TAB_CLIENTE SET 
        RAZAO_SOCIAL=:RAZAO_SOCIAL
        ,NOME_FANTASIA=:NOME_FANTASIA
        ,CNPJ=:CNPJ
        ,ENDERECO=:ENDERECO
        ,BAIRRO=:BAIRRO
        ,NUMERO=:NUMERO
        ,CEP=:CEP
        ,CIDADE=:CIDADE
        ,UF=:UF
        ,PROPRIETARIO=:PROPRIETARIO
        ,CELULAR=:CELULAR
        ,FONE_EMPRESA=:FONE_EMPRESA
        ,OBSERVACAO=:OBSERVACAO WHERE id=:id";


    $edit_cliente = $conexao->prepare($query_clientes);
    $edit_cliente->bindParam(':RAZAO_SOCIAL', $dados['RAZAO_SOCIAL']);
    $edit_cliente->bindParam(':NOME_FANTASIA', $dados['NOME_FANTASIA']);
    $edit_cliente->bindParam(':CNPJ', $dados['CNPJ']);
    $edit_cliente->bindParam(':ENDERECO', $dados['ENDERECO']);
    $edit_cliente->bindParam(':BAIRRO', $dados['BAIRRO']);
    $edit_cliente->bindParam(':NUMERO', $dados['NUMERO']);
    $edit_cliente->bindParam(':CEP', $dados['CEP']);
    $edit_cliente->bindParam(':CIDADE', $dados['CIDADE']);
    $edit_cliente->bindParam(':UF', $dados['UF']);
    $edit_cliente->bindParam(':PROPRIETARIO', $dados['PROPRIETARIO']);
    $edit_cliente->bindParam(':CELULAR', $dados['CELULAR']);
    $edit_cliente->bindParam(':FONE_EMPRESA', $dados['FONE_EMPRESA']);
    $edit_cliente->bindParam(':OBSERVACAO', $dados['OBSERVACAO']);
    $edit_cliente->bindParam(':id', $dados['id']);
    $edit_cliente->execute();
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Cliente editado com sucesso!</div>"];
}

echo json_encode($retorna);
