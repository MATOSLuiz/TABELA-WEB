<?php

require_once "conexao.php";

if (isset($_POST['update'])) {
    foreach ($_POST['positions'] as $position) {
        $index = $position[0];
        $newPosition = $position[1];

        $atualizaPrioridade = "UPDATE Tarefa SET TarOrdemPrioridade='$newPosition' WHERE TarID='$index'";
        $resultAtt = $conn->prepare($atualizaPrioridade);
        $resultAtt->execute();
    }
    exit('success');
}
