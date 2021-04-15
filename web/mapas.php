<?php 
error_reporting(E_ERROR | E_PARSE); 

include "includes/connect.php";

if (isset($_POST['cidade'])){
    $cidade = $_POST['cidade'];
    

    $exec_sql_select = pg_query($dbcon, "select mapas.id as id_mapa, mapas.nome as titulo, cidades.nome as cidade, descricao, end_arquivo from mapas inner join usuario on mapas.usuario_id = usuario.id inner join instituicao on usuario.instituicao_id = instituicao.id inner join cidades on instituicao.cidade_id = cidades.id where cidades.nome = '".$cidade."' and mapas.status = 1;");

    
    }

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>  
        <title>Atlas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <body>

    <a href="index.php" onclick=""><img id="logo" src="imagens/logo.jpg"/></a>
      
      <div id="menuu">
            <ul>
              <li><a id="inicial" href="index.php" onclick="">Página inicial</a></li>
              <li><a id="recurso" href="atlas2021/index.html" onclick="curSec(this.id)">Mapas</a></li>
              <li><a id="ajuda" href="#ajuda" onclick="curSec(this.id)">Ajuda</a></li>
              <li><a id="conta" href="login.php" onclick="">Fazer login</a></li>
              <li><a id="entrar" href="cadastrar.php" onclick="">Cadastre-se</a></li>
            </ul>
        </div>
    <div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                
                </div>
                <div class="col-sm-6">
                <form enctype="multipart/form-data" method="post" action="">
                <select class="form-control" placeholder="Estados" name="estado" id="estados" style="width: 35%;">
                       <option value=""></option>
                   </select>
                    <select class="form-control" placeholder="cidades" name="cidade" id="cidades" style="width: 35%; margin-left: 40%; margin-top: -35px;">
                       <option value=""></option>
                   </select>
                <input type="submit" id="add_bt" name ="submit" class="btn btn-success"  value="Buscar" /> 
                </form>    
            </div>
            </div>
        </div>
        <table class="table table-striped table-hover">

			<tr>
                <td>Título</td>
				<td>Descrição</td>
                <td>Cidade</td>
                <td>Visualizar</td>

			</tr>
			<?php 
			 while	($dado = pg_fetch_array($exec_sql_select)) {
				
			 ?>
				<tr>
					
                    <td><?php echo $dado['titulo']; ?></td>
					<td><?php echo $dado['descricao']; ?></td> 
                    <td><?php echo $dado['cidade']; ?></td>  
                    <td>
                    <a href="#" onCLick="window.open('<?php echo "http://localhost/Atlas_digital/".$dado['end_arquivo'];?>');"><i title="Visualizar" class="material-icons" data-toggle="tooltip">&#xe417;</i></a>
                </td>                
				</tr>
                
			<?php 
				}

		
			
			 ?>
		</table>
    </div>
	
</div>
    </body>
</html>
