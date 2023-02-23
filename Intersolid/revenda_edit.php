<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$consulta = "SELECT * FROM TAB_REVENDA WHERE CNPJ=:CNPJ AND id != :id";
$verifica_CNPJ = $conexao->prepare($consulta);
$verifica_CNPJ->bindParam(':CNPJ', $dados['CNPJ']);
$verifica_CNPJ->bindParam(':id', $dados['id']);
$verifica_CNPJ->execute();

if ($verifica_CNPJ->rowCount() > 0) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Revenda já cadastrada com esse CNPJ!</div>"];
} else {
    $query_revendas = "UPDATE TAB_REVENDA SET 
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
        ,TIPO=:TIPO
        ,OBSERVACAO=:OBSERVACAO WHERE id=:id";


    $edit_revenda = $conexao->prepare($query_revendas);
    $edit_revenda->bindParam(':RAZAO_SOCIAL', $dados['RAZAO_SOCIAL']);
    $edit_revenda->bindParam(':NOME_FANTASIA', $dados['NOME_FANTASIA']);
    $edit_revenda->bindParam(':CNPJ', $dados['CNPJ']);
    $edit_revenda->bindParam(':ENDERECO', $dados['ENDERECO']);
    $edit_revenda->bindParam(':BAIRRO', $dados['BAIRRO']);
    $edit_revenda->bindParam(':NUMERO', $dados['NUMERO']);
    $edit_revenda->bindParam(':CEP', $dados['CEP']);
    $edit_revenda->bindParam(':CIDADE', $dados['CIDADE']);
    $edit_revenda->bindParam(':UF', $dados['UF']);
    $edit_revenda->bindParam(':PROPRIETARIO', $dados['PROPRIETARIO']);
    $edit_revenda->bindParam(':CELULAR', $dados['CELULAR']);
    $edit_revenda->bindParam(':FONE_EMPRESA', $dados['FONE_EMPRESA']);
    $edit_revenda->bindParam(':TIPO', $dados['TIPO']);
    $edit_revenda->bindParam(':OBSERVACAO', $dados['OBSERVACAO']);
    $edit_revenda->bindParam(':id', $dados['id']);
    $edit_revenda->execute();
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Revenda editada com sucesso!</div>"];
}

echo json_encode($retorna);
