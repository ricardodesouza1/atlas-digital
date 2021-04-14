<?php
include "includes/connect.php";

$id = $_GET['id'];
$id_us = $_GET['id_us'];

$id_cidade = pg_query($dbcon, "SELECT cidade_id, end_arquivo FROM mapas where id = '".$id."'");
 if($id_cidade){
    while ($resultado_city = pg_fetch_array($id_cidade)) {
        $id_city = $resultado_city["cidade_id"];
        $end = $resultado_city["end_arquivo"];
    }
     $result = pg_query($dbcon, "DELETE FROM mapas where id = '" . $id . "';");
     if($result ){
        $deletcidade = pg_query($dbcon, "DELETE FROM cidades where id = '".$id_city ."'");
        if ($deletcidade) {
            header('Location: processa.php?id="'.$id_us.'"');
        
            echo $result;
        } else {
            //header('Location: projeto.php');
        }
     }
 }



