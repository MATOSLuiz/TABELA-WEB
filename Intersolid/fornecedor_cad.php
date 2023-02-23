<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


$consulta = "SELECT * FROM TAB_FORNECEDOR WHERE CNPJ=:CNPJ";
$verifica_fornecedor = $conexao->prepare($consulta);
$verifica_fornecedor->bindParam(':CNPJ', $dados['CNPJ']);
$verifica_fornecedor->execute();

if ($verifica_fornecedor->rowCount() == 1) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Fornecedor Já cadastrado com esse CNPJ!</div>"];
} else {
    $query_fornecedores = "INSERT INTO TAB_FORNECEDOR(
        RAZAO_SOCIAL,
        NOME_FANTASIA,
        CNPJ,
        ENDERECO,
        BAIRRO,
        NUMERO,
        CEP,
        CIDADE,
        UF,
        PROPRIETARIO,
        CELULAR,
        FONE_EMPRESA,
        OBSERVACAO
        ) VALUES (
            :RAZAO_SOCIAL,
            :NOME_FANTASIA,
            :CNPJ,
            :ENDERECO,
            :BAIRRO,
            :NUMERO,
            :CEP,
            :CIDADE,
            :UF,
            :PROPRIETARIO,
            :CELULAR,
            :FONE_EMPRESA,
            :OBSERVACAO
        )";


    $cad_fornecedor = $conexao->prepare($query_fornecedores);
    $cad_fornecedor->bindParam(':RAZAO_SOCIAL', $dados['RAZAO_SOCIAL']);
    $cad_fornecedor->bindParam(':NOME_FANTASIA', $dados['NOME_FANTASIA']);
    $cad_fornecedor->bindParam(':CNPJ', $dados['CNPJ']);
    $cad_fornecedor->bindParam(':ENDERECO', $dados['ENDERECO']);
    $cad_fornecedor->bindParam(':BAIRRO', $dados['BAIRRO']);
    $cad_fornecedor->bindParam(':NUMERO', $dados['NUMERO']);
    $cad_fornecedor->bindParam(':CEP', $dados['CEP']);
    $cad_fornecedor->bindParam(':CIDADE', $dados['CIDADE']);
    $cad_fornecedor->bindParam(':UF', $dados['UF']);
    $cad_fornecedor->bindParam(':PROPRIETARIO', $dados['PROPRIETARIO']);
    $cad_fornecedor->bindParam(':CELULAR', $dados['CELULAR']);
    $cad_fornecedor->bindParam(':FONE_EMPRESA', $dados['FONE_EMPRESA']);
    $cad_fornecedor->bindParam(':OBSERVACAO', $dados['OBSERVACAO']);

    $cad_fornecedor->execute();
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Fornecedor cadastrado com sucesso!</div>"];
}

echo json_encode($retorna);
