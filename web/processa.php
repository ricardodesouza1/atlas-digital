<?php 
error_reporting(E_ERROR | E_PARSE);

//error_reporting(E_ERROR | E_PARSE);
global $id_usuario;
$id_usuario = $_GET["id"];
//$con_string = "host=localhost dbname=atlas_v4 user=postgres password='123'";
//if(!$dbcon = pg_connect($con_string)) die ("Erro ao conectar ao banco<br>".pg_last_error($dbcon));
include "includes/connect.php";

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
       if ('.' === $file || '..' === $file) continue;
       if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
       else unlink("$dir/$file");
   }

   rmdir($dir);
}

if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            break;
        } 
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

  /* PHP current path */
  $path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

  $targetdir = $filenoext; // target directory
  $targetzip = $path . $filename; // target zip file
  $diretrio = 'mapas/'.$targetdir;
  /* create directory if not exists', otherwise overwrite */
  /* target directory is same as filename without extension */
    #$bdcon = pg_connect("dbname=atlas2");

    
  if (is_dir($diretrio))  rmdir_recursive ($diretrio);

 
  mkdir($diretrio, 0777);
  

    
  /* here it is really happening */

    if(move_uploaded_file($source, $targetzip)) {
        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  // open the zip file to extract
        if ($x === true) {
            $zip->extractTo($diretrio); // place in the directory with same name  
            $zip->close();

            unlink($targetzip);
        }
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $enderco = $diretrio.'/index.html';
        $insertcidades =  pg_query($dbcon, "INSERT INTO cidades VALUES(default, '".$cidade."','".$estado."');");
        
            if($insertcidades){
                $id_cidade = pg_query($dbcon, "SELECT id FROM cidades ORDER BY id DESC LIMIT 1");
                if($id_cidade){
                    while ($resultado_city = pg_fetch_array($id_cidade)) {
                        $id_city = $resultado_city["id"];
                    }
                    $sql_mapas =  pg_query($dbcon,"INSERT INTO mapas VALUES(default, '".$enderco."', '".$nome."', '".$descricao."','".$status."', '".$id_city."', '".$id_usuario."');");
                    $message = "Your .zip file was uploaded and unpacked.";
                }
            }
    } else {    
        $message = "There was a problem with the upload. Please try again.";
    }
}
if (isset($_GET['dado'])){
    $id_dado = $_GET['dado'];
    deletemapa($id_dado);
    
    }
    
if (isset($_GET['editar'])){
        $id_dado_edit = $_GET['editar'];
        $mapas_edit = pg_query($dbcon, "SELECT * FROM mapas where id = '".$id_dado_edit."'");
    
        
    }


function deletemapa($id_dado){    
    
    include "includes/connect.php";
   // $con_string = "host=localhost dbname=atlas_v4 user=postgres password='123'";
   // if(!$dbconn = pg_connect($con_string)) die ("Erro ao conectar ao banco<br>".pg_last_error($dbconn));
    
    $id_cidade = pg_query($dbcon, "SELECT cidade_id, end_arquivo FROM mapas where id = '".$id_dado."'");
 if($id_cidade){
    while ($resultado_city = pg_fetch_array($id_cidade)) {
        $id_city = $resultado_city["cidade_id"];
        $end = $resultado_city["end_arquivo"];
    }
     $result = pg_query($dbcon, "DELETE FROM mapas where id = '" . $id_dado . "';");
     if($result ){
        $deletcidade = pg_query($dbcon, "DELETE FROM cidades where id = '".$id_city ."'");
        if ($deletcidade) {
        
            return pg_query($deletcidade);
        } else {
            
        }
     }
 }
} 


 $exec_sql_select = pg_query($dbcon, "select mapas.id as id_mapa, mapas.nome as titulo, cidades.nome as cidade, descricao, end_arquivo from mapas inner join cidades on mapas.cidade_id = cidades.id where mapas.usuario_id = '".$id_usuario."';");
         
          
?>
<html>
<head>
	<title>Cadastro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

</head>
<script>
        

        $(document).ready(function () {
                
                $.getJSON('estados_cidades.json', function (data) {

                    var items = [];
                    var options = '<option value="">Escolha seu estado</option>';	

                    $.each(data, function (key, val) {
                        options += '<option value="' + val.nome + '">' + val.nome + '</option>';
                    });					
                    $("#estados").html(options);				
                    
                    $("#estados").change(function () {				
                    
                        var options_cidades = '';
                        var str = "";					
                        
                        $("#estados option:selected").each(function () {
                            str += $(this).text();
                        });
                        
                        $.each(data, function (key, val) {
                            if(val.nome == str) {							
                                $.each(val.cidades, function (key_city, val_city) {
                                    options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                                });							
                            }
                        });

                        $("#cidades").html(options_cidades);
                        
                    }).change();		
                
                });
            
            });
           
    </script>

<body >

<a href="index.php" onclick=""><img id="logo" src="imagens/logo.jpg"/></a>
      
      <div id="menuu">
            <ul>
              <li><a id="inicial" href="index.php" onclick="">Página inicial</a></li>
              <li><a id="ajuda" href="#ajuda" onclick="curSec(this.id)">Ajuda</a></li>
              <li><a id="logut" href="index.php" onclick="">Logut</a></li>
            </ul>

        </div>


<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Mapas Cadastrados</h2>
                </div>
                <div class="col-sm-6">
                <button type="button"  id="add_bt" data-toggle="modal" data-target="#addEmployeeModal">Adicionar</button> 
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">

			<tr>
                <td>Título</td>
				<td>Descrição</td>
                <td>Cidade</td>
                <td>Ações</td>

			</tr>
			<?php 
			 while	($dado = pg_fetch_array($exec_sql_select)) {
				
			 ?>
				<tr>
					
                    <td><?php echo $dado['titulo']; ?></td>
					<td><?php echo $dado['descricao']; ?></td> 
                    <td><?php echo $dado['cidade']; ?></td>  
                    <td>
                    <a href="?id=<?php echo $id_usuario; ?>&editar=<?php echo  $dado['id_mapa']; ?>" at="<?php echo  $dado['id_mapa']; ?>" class="edit"
                       data-toggle="modal" data-target="#editEmployeeModal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                   <a href="?id=<?php echo $id_usuario; ?>&dado=<?php echo  $dado['id_mapa']; ?>" class="delete"
                       data-toggle="modal" ><i class="material-icons" data-toggle="tooltip"
                                              title="Delete">&#xE872;</i></a> 
                    <a href="#" onCLick="window.open('<?php echo "http://localhost/Atlas_digital/".$dado['end_arquivo'];?>');"><i title="Visualizar" class="material-icons" data-toggle="tooltip">&#xe417;</i></a>
                </td>                
				</tr>
                
			<?php 
				}

		
			
			 ?>
		</table>
    </div>
	
</div>

<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="">
                <div class="modal-body">
                    <input type="text" class="form-control" name="nome" placeholder="Título"  value="<?php if(isset($resposta)){echo $resposta['nome'];} ?>">
                    <p></p>
                    <textarea type="text" class="form-control" name="descricao" placeholder="Descrição"   value="<?php if(isset($resposta)){echo $resposta['descricao'];} ?>"></textarea>
                    <p></p>
                    <input type="file" class="form-control" name="zip_file" required/>
                    <p></p>
                    <select class="form-control" placeholder="Estados" name="estado" id="estados">
                       <option value=""></option>
                   </select>
                   <p></p>
                    <select class="form-control" placeholder="Estados" name="cidade" id="cidades">
                       <option value=""></option>
                   </select>
                   <p></p> 
                    <select class="form-control" name="status">
                       <option value="1">Público</option>
                       <option value="2">Privado</option>
                   </select>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" name ="submit" class="btn btn-success"  value="salvar">
                </div>
                <br><br><br>
                
            </form>
        </div>
    </div> 
</div>

<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="">
                <div class="modal-body">
                <?php
                 while ($resultado = pg_fetch_array($mapas_edit)) {

                ?>
                    <input type="text" class="form-control" name="edit_nome" placeholder="Nome"  value="<?php echo $resultado['nome'];?>">
                    <p></p>
                    <textarea type="text" class="form-control" name="edit_descricao" placeholder="Descrição"   value="<?php echo $resultado['descricao']; ?>"></textarea>
                    <p></p>
                    <input type="file" class="form-control" name="edit_zip_file" required value="<?php echo $resultado['end_arquivo']; ?>"/>
                    <p></p>
                    <select class="form-control" placeholder="Estados" name="edit_estado" id="estados" value="<?php echo $resultado['estado'];?> >
                       <option value=""></option>
                   </select>
                   <p></p>
                    <select class="form-control" placeholder="Estados" name="edit_cidade" id="cidades">
                       <option value=""></option>
                   </select>
                   <p></p>
                    <select class="form-control" name="edit_status">
                       <option value="1">Público</option>
                       <option value="2">Privado</option>
                   </select>
                </div>
                <?php } ?>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" name ="submit" class="btn btn-success"  value="salvar">
                </div>
                <br><br><br>
                
            </form>
        </div>
    </div> 
</div>
<!--
<div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Deletar Mapa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Você tem certeza que deseja deletar esse Mapa?</p>
                        <p class="text-warning"><small>Essa ação não pode ser revertida.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" id="deletando" onclick="deletar()" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
-->

</body>
</html>
