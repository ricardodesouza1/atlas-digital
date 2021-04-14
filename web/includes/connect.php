<?php

     $servidor = "localhost";
     $porta = 5432;
     $bancoDeDados = "nome_do_banco";
     $usuario = "postgres";
     $senha = "senha_do_banco";

	$con_string = "host=$servidor port=$porta dbname=$bancoDeDados user=$usuario password=$senha";

	if(!$dbcon = pg_connect($con_string)) die ("Erro ao conectar ao banco<br>".pg_last_error($dbcon));


?>
