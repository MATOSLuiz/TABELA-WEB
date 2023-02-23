<?php

$cod_revenda = $_SESSION['cod_revenda'];

$rowsTarefas = ("WITH TarefasRevenda as 
(select distinct 
     NomeCliente as Cliente
    ,SolIDInclusao AS Chamado
    ,TarID as TarefaID
    ,TarTitulo as Titulo
    ,natdescricao AS Natureza
    ,TarData as Abertura
    ,RESP.UsuNome as Responsavel
    ,EstagioDesc as Estagio
    ,TarOrdemPrioridade as Prioridade 
    ,VersaoL as Versaolib
from Tarefa T
 inner join ProdutoUsuarioCliente PUC on PUC.UsuIDCliente = T.UsuIDCliente
 inner join natureza on (T.NatID = natureza.natid AND T.proid = natureza.proid)
 left join estagio on (T.tarestagioid = estagio.estagioid AND T.proid = estagio.proid) 
 left join Usuario RESP on RESP.UsuID = T.UsuIDResponsavel
where PUC.UsuID = $cod_revenda
AND TarStatus <> 9
AND t.natid IN (6,15,16))


select count(*) 
from TarefasRevenda;
");

$linhas = $conn->prepare($rowsTarefas);
$linhas->execute();

$rows = $linhas->fetchColumn();

$tarefas = ("WITH TarefasRevenda as 
(select distinct 
     NomeCliente as Cliente
    ,SolIDInclusao AS Chamado
    ,TarID as TarefaID
    ,TarTitulo as Titulo
    ,natdescricao AS Natureza
    ,TarData as Abertura
    ,RESP.UsuNome as Responsavel
    ,EstagioDesc as Estagio
    ,TarOrdemPrioridade as Prioridade 
    ,VersaoL as Versaolib
from Tarefa T
 inner join ProdutoUsuarioCliente PUC on PUC.UsuIDCliente = T.UsuIDCliente
 inner join natureza on (T.NatID = natureza.natid AND T.proid = natureza.proid)
 left join estagio on (T.tarestagioid = estagio.estagioid AND T.proid = estagio.proid) 
 left join Usuario RESP on RESP.UsuID = T.UsuIDResponsavel
where PUC.UsuID = $cod_revenda
AND TarStatus <> 9
AND t.natid IN (6,15,16))


select * 
from TarefasRevenda
order by Prioridade ASC, Chamado DESC;
");

$resulttarefas = $conn->prepare($tarefas);
$resulttarefas->execute();
