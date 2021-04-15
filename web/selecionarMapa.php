<?php

include "includes/connect.php";

$id = $_GET['id'];

$tecido = pg_query($dbcon, "select * from mapas where id = '".$id."'");

while ($retorno = pg_fetch_array($tecido)) {
    $id = $retorno["id"];
    $end = $retorno["end_arquivo"];
    $nome = $retorno["nome"];
    $descricao = $retorno["descricao"];
    $status = $retorno["status"];
    $codigo= $retorno["codigo"];
    $usuario_id = $retorno["usuario_id"];
}

$vetor = array("id" => $id, "end" => $end, "nome" => $nome, "descricao" => $descricao, "status" => $status, "codigo" => $codigo, "usuario_id" => $usuario_id);
$retornar = json_encode($vetor);
print_r($retornar);
//echo $nome;