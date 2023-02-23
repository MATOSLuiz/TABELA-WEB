<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Removendo máscara dos campos
if (isset($dados['VALOR_MINIMO'])) {
    $valorMinimo = preg_replace("/[^0-9,]/", "", $dados['VALOR_MINIMO']);
    $valorMinimo = str_replace(",", ".", $valorMinimo);
}

if (isset($dados['VALOR_TABELA'])) {
    $valorTabela = preg_replace("/[^0-9,]/", "", $dados['VALOR_TABELA']);
    $valorTabela = str_replace(",", ".", $valorTabela);
}

if (isset($dados['VALOR_IMPLANTACAO'])) {
    $valorImplantacao = preg_replace("/[^0-9,]/", "", $dados['VALOR_IMPLANTACAO']);
    $valorImplantacao = str_replace(",", ".", $valorImplantacao);
}

$query_produtos = "INSERT INTO TAB_PRODUTO(
        NOME,
        FORNECEDOR_ID,
        TIPO_VALOR,
        EXIBE_PEDIDO,
        VALOR_TABELA,
        VALOR_MINIMO,
        VALOR_IMPLANTACAO,
        OBSERVACAO
        ) VALUES (
            :NOME,
            :FORNECEDOR_ID,
            :TIPO_VALOR,
            :EXIBE_PEDIDO,
            :VALOR_TABELA,
            :VALOR_MINIMO,
            :VALOR_IMPLANTACAO,
            :OBSERVACAO
        )";

$formater = [
    "NOME" => $dados['NOME'],
    "FORNECEDOR_ID" => $dados['FORNECEDOR_ID'],
    "TIPO_VALOR" => $dados['TIPO_VALOR'],
    "EXIBE_PEDIDO" => $dados['EXIBE_PEDIDO'],
    "VALOR_TABELA" => isset($valorTabela) ? $valorTabela : 0,
    "VALOR_MINIMO" => isset($valorMinimo) ? $valorMinimo : 0,
    "VALOR_IMPLANTACAO" => isset($valorImplantacao) && $valorImplantacao != "" ? $valorImplantacao : 0,
    "OBSERVACAO" => $dados['OBSERVACAO']
];

$cad_produto = $conexao->prepare($query_produtos)->execute($formater);

$id_produto = $conexao->lastInsertId();


if ($cad_produto) {

    if (isset($dados['MODULO'])) {
        foreach ($dados['MODULO'] as $chave => $MODULO) {

            if (isset($dados['VALOR'][$chave])) {
                $valorMod = preg_replace("/[^0-9,]/", "", $dados['VALOR'][$chave]);
                $valorMod = str_replace(",", ".", $valorMod);
            }

            $query_modulos = "INSERT INTO TAB_MODULO(
                MODULO,
                VALOR,
                produto_id 
                ) VALUES (
                    :MODULO,
                    :VALOR,
                    :produto_id
                )";

            $formaterModulo = [
                "MODULO" => $MODULO,
                "VALOR" => $valorMod ? $valorMod : 0,
                "produto_id" => $id_produto
            ];

            $cad_modulo = $conexao->prepare($query_modulos)->execute($formaterModulo);
        }
    }
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Produto cadastrado com sucesso!</div>"];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Erro</div>"];
}

echo json_encode($retorna);
