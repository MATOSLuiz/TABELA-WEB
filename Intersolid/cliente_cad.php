<?php
    require_once("../conexaomysql.php");

    $dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

    $consulta = "SELECT * FROM TAB_CLIENTE WHERE CNPJ=:CNPJ";
    $verifica_cliente = $conexao->prepare($consulta);
    $verifica_cliente->bindParam(':CNPJ',$dados['CNPJ']);
    $verifica_cliente->execute();

    if($verifica_cliente->rowCount() == 1) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-warning'>Cliente já cadastrado com esse CNPJ!</div>"];
    } else {
        $query_clientes = "INSERT INTO TAB_CLIENTE(
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
    
    
    $cad_cliente = $conexao->prepare($query_clientes);
    $cad_cliente->bindParam(':RAZAO_SOCIAL', $dados['RAZAO_SOCIAL']);
    $cad_cliente->bindParam(':NOME_FANTASIA', $dados['NOME_FANTASIA']);
    $cad_cliente->bindParam(':CNPJ', $dados['CNPJ']);
    $cad_cliente->bindParam(':ENDERECO', $dados['ENDERECO']);
    $cad_cliente->bindParam(':BAIRRO', $dados['BAIRRO']);
    $cad_cliente->bindParam(':NUMERO', $dados['NUMERO']);
    $cad_cliente->bindParam(':CEP', $dados['CEP']);
    $cad_cliente->bindParam(':CIDADE', $dados['CIDADE']);
    $cad_cliente->bindParam(':UF', $dados['UF']);
    $cad_cliente->bindParam(':PROPRIETARIO', $dados['PROPRIETARIO']);
    $cad_cliente->bindParam(':CELULAR', $dados['CELULAR']);
    $cad_cliente->bindParam(':FONE_EMPRESA', $dados['FONE_EMPRESA']);
    $cad_cliente->bindParam(':OBSERVACAO', $dados['OBSERVACAO']);
    
    $cad_cliente->execute();
    $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'>Cliente cadastrado com sucesso!</div>"];
    }

echo json_encode($retorna);
