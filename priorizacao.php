<link href="../assets/bootstrap.min.css" rel="stylesheet">
<?php
require_once "alteraPrioridade.php";
require_once "protect.php";
require_once "queries.php";
verificaIntersolid($_SESSION['id']);
?>
<?php

require_once("layouts/header.php");

?>

<body>
    <?php

    require_once("layouts/navbar.php");

    ?>
    <div class="container mt-5">
        <div class="row">
            <table class="table table-striped shadow p-3 mb-5">
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
                <tbody>
                    <?php
                    while ($Tarefa = $resulttarefas->fetch(PDO::FETCH_ASSOC)) {

                        //Query para pegar dataprevisao liberacao
                        $previsao = "SELECT VerDataPrevLib as dataprev FROM tipoversao
                                    WHERE
                                        proid = 1
                                    AND
                                        versao = '" . $Tarefa['Versaolib'] . "'";
                        $resultprevisao =
                            $conn->prepare($previsao);
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
                                    <td>' . $Tarefa['Versaolib'] . " - " . $DataPrev['dataprev'] = isset($DataPrev['dataprev']) ? date("d/m/Y", strtotime($DataPrev['dataprev'])) : '';'</td> 
                                </tr>  
                            ';
                    }
                    ?>


                </tbody>
            </table>
        </div>
</body>

</html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="./js/mudaPrioridade.js"></script>