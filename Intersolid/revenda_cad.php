<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$consulta = "SELECT * FROM TAB_REVENDA WHERE CNPJ=:CNPJ";
$verifica_revenda = $conexao->prepare($consulta);
$verifica_revenda->bindParam(':CNPJ', $dados['CNPJ']);
$verifica_revenda->execute();

if ($verifica_revenda->rowCount() == 1) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Revenda já cadastrada com esse CNPJ!</div>"];
} else {
    $query_revendas = "INSERT INTO TAB_REVENDA(
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
            TIPO,
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
                :TIPO,
                :OBSERVACAO
            )";


    $cad_revenda = $conexao->prepare($query_revendas);
    $cad_revenda->bindParam(':RAZAO_SOCIAL', $dados['RAZAO_SOCIAL']);
    $cad_revenda->bindParam(':NOME_FANTASIA', $dados['NOME_FANTASIA']);
    $cad_revenda->bindParam(':CNPJ', $dados['CNPJ']);
    $cad_revenda->bindParam(':ENDERECO', $dados['ENDERECO']);
    $cad_revenda->bindParam(':BAIRRO', $dados['BAIRRO']);
    $cad_revenda->bindParam(':NUMERO', $dados['NUMERO']);
    $cad_revenda->bindParam(':CEP', $dados['CEP']);
    $cad_revenda->bindParam(':CIDADE', $dados['CIDADE']);
    $cad_revenda->bindParam(':UF', $dados['UF']);
    $cad_revenda->bindParam(':PROPRIETARIO', $dados['PROPRIETARIO']);
    $cad_revenda->bindParam(':CELULAR', $dados['CELULAR']);
    $cad_revenda->bindParam(':FONE_EMPRESA', $dados['FONE_EMPRESA']);
    $cad_revenda->bindParam(':TIPO', $dados['TIPO']);
    $cad_revenda->bindParam(':OBSERVACAO', $dados['OBSERVACAO']);

    $cad_revenda->execute();
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Revenda cadastrada com sucesso!</div>"];
}

echo json_encode($retorna);
