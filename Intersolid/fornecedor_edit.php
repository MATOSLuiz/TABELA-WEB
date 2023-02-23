<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$consulta = "SELECT * FROM TAB_FORNECEDOR WHERE CNPJ=:CNPJ AND id != :id";
$verifica_CNPJ = $conexao->prepare($consulta);
$verifica_CNPJ->bindParam(':CNPJ', $dados['CNPJ']);
$verifica_CNPJ->bindParam(':id', $dados['id']);
$verifica_CNPJ->execute();

if ($verifica_CNPJ->rowCount() > 0) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Fornecedor já cadastrado com esse CNPJ!</div>"];
} else {
    $query_fornecedores = "UPDATE TAB_FORNECEDOR SET 
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


    $edit_fornecedor = $conexao->prepare($query_fornecedores);
    $edit_fornecedor->bindParam(':RAZAO_SOCIAL', $dados['RAZAO_SOCIAL']);
    $edit_fornecedor->bindParam(':NOME_FANTASIA', $dados['NOME_FANTASIA']);
    $edit_fornecedor->bindParam(':CNPJ', $dados['CNPJ']);
    $edit_fornecedor->bindParam(':ENDERECO', $dados['ENDERECO']);
    $edit_fornecedor->bindParam(':BAIRRO', $dados['BAIRRO']);
    $edit_fornecedor->bindParam(':NUMERO', $dados['NUMERO']);
    $edit_fornecedor->bindParam(':CEP', $dados['CEP']);
    $edit_fornecedor->bindParam(':CIDADE', $dados['CIDADE']);
    $edit_fornecedor->bindParam(':UF', $dados['UF']);
    $edit_fornecedor->bindParam(':PROPRIETARIO', $dados['PROPRIETARIO']);
    $edit_fornecedor->bindParam(':CELULAR', $dados['CELULAR']);
    $edit_fornecedor->bindParam(':FONE_EMPRESA', $dados['FONE_EMPRESA']);
    $edit_fornecedor->bindParam(':OBSERVACAO', $dados['OBSERVACAO']);
    $edit_fornecedor->bindParam(':id', $dados['id']);
    $edit_fornecedor->execute();
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Fornecedor editado com sucesso!</div>"];
}

echo json_encode($retorna);
