<link href="../assets/bootstrap.min.css" rel="stylesheet">
<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    echo "
    <div class = 'container center-block mt-5'>
    <p class=' alert alert-info text-center'>Você não tem acesso a essa pagina retorne a página anterior para prosseguir!</p></div>
    ";
    die("");
}

//Se a intersolid tentar acessar a priorização de tarefas será barrada.

function verificaIntersolid($id)
{
    if ($id == 0) {
        echo "
        <div class = 'container center-block mt-5'>
        <p class=' alert alert-info text-center'>Você não tem acesso a essa pagina retorne a página anterior para prosseguir!</p></div>
        ";
        die("");
    }
}

// se a revenda tentar ter a visão da intersolid será barrada.

function verificaRevenda($id)
{
    if ($id != 0) {
        echo "
        <div class = 'container center-block mt-5'>
        <p class=' alert alert-info text-center'>Você não tem acesso a essa pagina retorne a página anterior para prosseguir!</p></div>
        ";
        die("");
    }
}

function verificaTarefa($Prioridade)
{
    if ($Prioridade == 0) {
        echo "<td> Tarefa ainda não priorizada</td>";
    }
}


?>