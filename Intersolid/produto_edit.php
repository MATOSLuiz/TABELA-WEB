<?php
require_once("../conexaomysql.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Removendo máscara dos campos antes de atualizar no banco

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

$query_produtos = "UPDATE TAB_PRODUTO SET 
     NOME=:NOME
    ,FORNECEDOR_ID=:FORNECEDOR_ID
    ,TIPO_VALOR=:TIPO_VALOR
    ,EXIBE_PEDIDO=:EXIBE_PEDIDO
    ,VALOR_TABELA=:VALOR_TABELA
    ,VALOR_MINIMO=:VALOR_MINIMO
    ,VALOR_IMPLANTACAO=:VALOR_IMPLANTACAO
    ,OBSERVACAO=:OBSERVACAO 
    WHERE id=:id";

$formater = [
    "NOME" => $dados['NOME'],
    "FORNECEDOR_ID" => $dados['FORNECEDOR_ID'],
    "TIPO_VALOR" => $dados['TIPO_VALOR'],
    "EXIBE_PEDIDO" => $dados['EXIBE_PEDIDO'],
    "VALOR_TABELA" => isset($valorTabela) ? $valorTabela : 0,
    "VALOR_MINIMO" => isset($valorMinimo) ? $valorMinimo : 0,
    "VALOR_IMPLANTACAO" => isset($valorImplantacao) && $valorImplantacao != "" ? $valorImplantacao : 0,
    "OBSERVACAO" => $dados['OBSERVACAO'],
    "id" => $dados['id']
];

$edit_produto = $conexao->prepare($query_produtos)->execute($formater);


// $edit_produto->execute();

// $rowcount = $edit_produto->rowCount();

if ($edit_produto) {

    if (isset($dados['MODULO'])) {
        for ($i = 0; $i < count($dados['MODULO']); $i++) {

            $MODULO = $dados['MODULO'][$i];

            if (isset($dados['VALOR'][$i])) {
                $valorMod = preg_replace("/[^0-9,]/", "", $dados['VALOR'][$i]);
                $valorMod = str_replace(",", ".", $valorMod);
            }

            $query_modulos = "UPDATE TAB_MODULO SET 
            MODULO=:MODULO,
            VALOR=:VALOR
            WHERE id=:modulo_id";

            $formaterModulo = [
                "MODULO" => $MODULO,
                "VALOR" => $valorMod ? $valorMod : 0,
                "modulo_id" => $dados['modulo_id'][$i]
            ];

            $edit_modulo = $conexao->prepare($query_modulos)->execute($formaterModulo);
        }
    }
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Produto Editado com sucesso!</div>"];
} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Erro</div>"];
}

echo json_encode($retorna);
