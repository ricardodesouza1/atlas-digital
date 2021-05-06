<?php 
error_reporting(E_ERROR | E_PARSE);

//controle de sessão
session_start();
if(@$_SESSION["id"]==""){
        header("location:index.php");
}



global $id_usuario;
$id_usuario = $_GET["id"];
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
        $message = "Este arquvo não é um .zip";
    }

  $path = dirname(__FILE__).'/';  
  $filenoext = basename ($filename, '.zip');  
  $filenoext = basename ($filenoext, '.ZIP');  

  $targetdir = $filenoext; 
  $targetzip = $path . $filename; 
  $diretrio = 'mapas/'.$targetdir;

    
  if (is_dir($diretrio))  rmdir_recursive ($diretrio);

 
  mkdir($diretrio, 0777);
  



    if(move_uploaded_file($source, $targetzip)) {
        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  
        if ($x === true) {
            $zip->extractTo($diretrio); 
            $zip->close();

            unlink($targetzip);
        }
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $codigo_cadastro = $_POST['codigo_cadastro'];
        $enderco = $diretrio.'/index.html';
    
        $sql_mapas =  pg_query($dbcon,"INSERT INTO mapas VALUES(default, '".$enderco."', '".$nome."', '".$descricao."','".$status."', '".$codigo_cadastro."', '".$id_usuario."');");
        $message = "Sucesso!!!";
            
    } else {    
        $message = "Erro!!!";
    }
}
if (isset($_GET['dado'])){
    $id_dado = $_GET['dado'];
    deletemapa($id_dado);
    
    }
    
if (isset($_POST['edit_id'])){
            $id_dado_edit = $_POST['edit_id'];
            $edit_nome = $_POST['edit_nome'];
            $edit_descricao = $_POST['edit_descricao'];
            $edit_status = $_POST['edit_status'];
            $edit_codigo_cadastro = $_POST['edit_codigo_cadastro'];
        
            $update = pg_query($dbcon, "UPDATE mapas SET  nome = '" . $edit_nome . "',  descricao = '" . $edit_descricao . "',  status = '" . $edit_status . "',  codigo = '" . $edit_codigo_cadastro . "' where id = '".$id_dado_edit."'");
            $message = "Sucesso!!!";
                
        } else {    
            $message = "Erro!!!";
}
    
        
function delTree($dir) { 
        $files = array_diff(scandir($dir), array('.','..')); 
        foreach ($files as $file) { 
          (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
}


function deletemapa($id_dado){    
    
    include "includes/connect.php";
    $id_cidade = pg_query($dbcon, "SELECT end_arquivo FROM mapas where id = '".$id_dado."'");
 if($id_cidade){
    while ($resultado = pg_fetch_array($id_cidade)) {
        $end = $resultado["end_arquivo"];
    }
     $result = pg_query($dbcon, "DELETE FROM mapas where id = '" . $id_dado . "';");
     if($result ){
        $text = strstr($end, "/index.html", true); 
        delTree($text);
            
            return pg_query($deletcidade);
        } else {
            
     }
 }
} 




 $exec_sql_select = pg_query($dbcon, "select mapas.id as id_mapa, mapas.nome as titulo, cidades.nome as cidade, descricao, end_arquivo from mapas inner join usuario on mapas.usuario_id = usuario.id inner join instituicao on usuario.instituicao_id = instituicao.id inner join cidades on instituicao.cidade_id = cidades.id where mapas.usuario_id = '".$id_usuario."';");
         
          
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


<body >

<a href="index.php" onclick=""><img id="logo" src="imagens/logo.jpg"/></a>
      
      <div id="menuu">
            <ul>
              <li><a id="inicial" href="index.php" onclick="">Página inicial</a></li>
              <li><a id="recurso" href="mapas.php" onclick="curSec(this.id)">Mapas</a></li>
              <li><a id="ajuda" href="#ajuda" onclick="curSec(this.id)">Ajuda</a></li>
              <li><a id="logut" href="index.php?sair=ok" onclick="">Logut</a></li>
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
                    <a href="#editModal" at="<?php echo $dado["id_mapa"]; ?>" class="edit" data-toggle="modal" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="?id=<?php echo $id_usuario; ?>&dado=<?php echo $dado['id_mapa']; ?>" onclick="return confirm('Deseja mesmo excluir este mapa?');"class="delete" data-toggle="modal" ><i class="material-icons" data-toggle="tooltip" title="Delete" >&#xE872;</i></a> 
                    <a target="_BLANK" href="<?=$dado['end_arquivo'];?>"><i title="Visualizar" class="material-icons" data-toggle="tooltip">&#xe417;</i></a>
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
                    <select class="form-control" name="status" onchange="habilitar(this.value)">
                       <option value="1">Público</option>
                       <option value="2">Privado</option>
                   </select>
                   <p></p>
                   <input type="text" class="form-control" id="codigo_cadastro"  name="codigo_cadastro" placeholder="Código" disabled="">
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

<div id="editModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="">
                <div class="modal-body">
                    <input type="text" class="form-control" name="edit_id" id="edit_id" style="display: none;" >
                    <input type="text" class="form-control" name="edit_nome" id="edit_nome" placeholder="Nome" >
                    <p></p>
                    <textarea type="text" class="form-control" name="edit_descricao" id="edit_descricao" placeholder="Descrição"  ></textarea>
                    <p></p>
                    <!--<input type="file" class="form-control" name="edit_zip_file" required />
                    <p></p>-->
                    <select class="form-control" name="edit_status" id="edit_status" onchange="habilitar_edit(this.value)">
                       <option value="1">Público</option>
                       <option value="2">Privado</option>
                   </select> 
                   <p></p>
                   <input type="text" class="form-control" id="edit_codigo"  name="edit_codigo_cadastro" placeholder="Código" disabled="">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" name ="submit" class="btn btn-success"  value="Editar">
                </div>
                <br><br><br>
                
            </form>
        </div>
    </div> 
</div>
<script>
         window.status_id = 0;
        $(document).ready(function() {
            $("a.edit").click( function() {
                window.status_id = $(this).attr('at');
                $.ajax({
                    type: "GET",
                    data: {
                        id: status_id
                    },
                    dataType: 'json',
                    url: "selecionarMapa.php",
                    success: function(msg) {
                        $("#edit_id").val(msg["id"])
                        $("#edit_end").val(msg["end"])
                        $("#edit_nome").val(msg["nome"]);
                        $("#edit_descricao").val(msg["descricao"]);
                        $("#edit_status").val(msg["status"]);
                        if($("#edit_codigo").val(msg["codigo"]) != ""){
                            document.getElementById('edit_codigo').removeAttribute("disabled");

                        }

                    }

                });
            });
        });

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
            function habilitar(value) {
                var input = document.getElementById("codigo_cadastro");

                if (value == 1) {
                    input.disabled = true;
                    input.value='';
                } else {
                    input.disabled = false;
                }
             }
             function habilitar_edit(value) {
                var input = document.getElementById("edit_codigo");

                if (value == 1) {
                    input.disabled = true;
                    input.value='';
                } else {
                    input.disabled = false;
                }
             }
           
    </script>

</body>
</html>
