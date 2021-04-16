<?php

     $servidor = "localhost";
     $porta = 5432;
     $bancoDeDados = "atlas_v7";
     $usuario = "postgres";
     $senha = "postgres123";

	$con_string = "host=$servidor port=$porta dbname=$bancoDeDados user=$usuario password=$senha";

	if(!$dbcon = pg_connect($con_string)) die ("Erro ao conectar ao banco<br>".pg_last_error($dbcon));

?>
