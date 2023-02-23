<link href="../assets/bootstrap.min.css" rel="stylesheet">

<?php
require_once('../protect.php');
verificaRevenda($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Priorização - Intersolid</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="../assets/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<style>
    table tbody td {
        cursor: auto;
    }

    input {
        font-size: 15px;
    }
</style>

<body>
    <?php

    require_once("layouts/navbar.php");

    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-8 d-flex justify-content-start mb-3">
                <form class='p-2' style="border: 1px solid black; border-radius:10px;" method="POST" action="index.php">
                    <?php

                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                    $valor_pesq_list = "0";
                    if (!empty($dados['revenda_ID'])) {
                        foreach ($dados['revenda_ID'] as $usuid) {
                            $valor_pesq_list .= "$usuid, ";
                        }
                    }

                    require_once "../conexaomysql.php";

                    $queryCodRevendas = "SELECT id, nome from revendas order by nome asc";
                    $resultCodRevendas = $con->query($queryCodRevendas);

                    echo "<input class='mx-3' type='checkbox' id='checkTodos' name='checkTodos' checked> Todas";
                    while ($row_cod_revenda = mysqli_fetch_assoc($resultCodRevendas)) {
                        extract($row_cod_revenda);
                        $result_valor = mb_strpos($valor_pesq_list, $id);
                        if ($result_valor === false) {
                            $checked = "";
                        } else {
                            $checked = "checked";
                        }
                        // var_dump($row_cod_revenda);
                        echo "<input class='mx-3' type='checkbox' name='revenda_ID[]' value='$id' $checked>$nome";
                    }
                    echo "<input type='submit' value='Filtrar' class='btn btn-sm btn-success ms-5' name='PesqTarefa'>";
                    ?>

                </form>

            </div>
        </div>

        <table class="table table-sm table-striped shadow p-3 mb-5">
            <thead class="table-warning">
                <td>Prioridade</td>
                <td>Cliente</td>
                <td>Chamado</td>
                <td>Tarefa</td>
                <td>Titulo</td>
                <td>Natureza</td>
                <td>Abertura</td>
                <td>Responsável</td>
                <td>Estágio</td>
                <td>V.Liberação - Previsão</td>
            </thead>
            <tbody class="cursor">

                <?php

                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


                if (!empty($dados['PesqTarefa'])) {

                    $valor_pesq = "0";
                    $controle = 1;
                    if (!empty($dados['revenda_ID'])) {
                        foreach ($dados['revenda_ID'] as $usuid) {
                            if ($controle == 1) {
                                $valor_pesq .= "$usuid";
                            } else {
                                $valor_pesq .= ", $usuid";
                            }
                            $controle++;
                        }
                    }

                    require_once "queries.php";

                    while ($Tarefa = $resulttarefas->fetch(PDO::FETCH_ASSOC)) {

                        $previsao = "SELECT VerDataPrevLib as dataprev FROM tipoversao
                                    WHERE
                                        proid = 1
                                    AND
                                        versao = '" . $Tarefa['Versaolib'] .  "'";
                        $resultprevisao = $conn->prepare($previsao);
                        $resultprevisao->execute();
                        $DataPrev = $resultprevisao->fetch(PDO::FETCH_ASSOC);

                        echo '
                                        <tr data-index="' . $Tarefa['TarefaID'] . '" data-position="' . $Tarefa['Prioridade'] . '">
                                            <td>' . $Tarefa['Prioridade'] . '</td>
                                            <td>' . $Tarefa['Cliente'] . '</td>   
                                            <td>' . $Tarefa['Chamado'] . '</td>   
                                            <td>' . $Tarefa['TarefaID'] . '</td>   
                                            <td>' . $Tarefa['Titulo'] . '</td>   
                                            <td>' . $Tarefa['Natureza'] . '</td>   
                                            <td>' . date("d/m/Y", strtotime($Tarefa['Abertura'])) . '</td>   
                                            <td>' . $Tarefa['Responsavel'] . '</td>   
                                            <td>' . $Tarefa['Estagio'] . '</td> 
                                            <td>' . $Tarefa['Versaolib'] . " - " . $DataPrev['dataprev'] = isset($Tarefa['Versaolib']) ? date("d/m/Y", strtotime($DataPrev['dataprev'])) : '';'</td>   
                                        </tr> 
                                     
                                    ';
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

</body>

</html>
<script src="../js/filtros.js"></script>