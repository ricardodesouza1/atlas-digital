<?php

    require_once ("CLASSES/usuario.php"); 
    include_once 'CLASSES/usuario.php';
    require_once 'CLASSES/usuario.php';
	
     $u = new Usuario;

    

     $msg = false;

     if (isset($_FILES['arquivo'])) {
     	
     	$u->conectar("atlas","localhost","ricardo","123");

     	$extensao = strtolower(substr($_FILES['arquivo']['name'], -5));
     	$novo_name = md5(time()) . $extensao;
     	$diretorio = "upload/";
     	$nome = $_POST['nome'];

	//$t = imagejpeg($novo_name, null, 70);
     	

     	move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_name);

     	$u->upload($novo_name, $nome);
     }

     	  $u->conectar("atlas","localhost","ricardo","123");
          $sql = "SELECT * from mapas";

          $consulta = $pdo->query($sql);

          While($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            $album[] = $linha;
              # code...
            }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Arquivo</title>
	<meta charset="utf-8">
</head>
<body>

<h1>Upload de Arquivos</h1>


	<?php
		if (isset($_GET['id_atualizar'])) {
			$codigo = $_GET['id_atualizar'];
			$resposta = $u->buscarDadosMapa($codigo);

		}
			
	 ?>

<form action="upload.php" method="POST" enctype="multipart/form-data">
	
	Nome do Mapa: <input type="text" name="nome" size="50" maxlength="50" id="s_nome" value="<?php if(isset($resposta)){echo $resposta['nome'];} ?>">

	<br><br><br>
	Arquivo: <input type="file" required name="arquivo" id="s_arquivo">
	<input type="submit" value="<?php if(isset($resposta)){echo "Atualizar";}else{
		echo "Cadastrar";} ?>">

	<br><br><br>
	<div>
		<table border="1">
			<tr>
				
				<td>Nº Banco</td>
				<td>Nome</td>
				<td>Arquivo</td>
				<td>Data/horário</td>
				<td>Editar</td>
				<td>Excluir</td>

			</tr>
			<?php 
				foreach ($album as $dado) {
				$a = $a+1;
			 ?>
				<tr>
					<td><?php echo $a; ?></td>
					<td><?php echo $dado['nome']; ?></td>
					<td><?php echo $dado['arquivo']; ?></td>
					<td><?php echo $dado['data']; ?></td>
					<td><a href="upload.php?id_atualizar=<?php echo $dado['codigo']; ?>">Editar</a></td>
					<td><a href="upload.php?id_excluir=<?php echo $dado['codigo']; ?>">Excluir</a></td>
				</tr>
			<?php 
				}

				if (isset($_GET['id_excluir'])) {
					
					$id_mapa = addslashes($_GET['id_excluir']);
					$u->excluirBanco($id_mapa);
					header("location: upload.php");
				}
			
			 ?>
		</table>
	
	</div>
</form>
</body>
</html>
