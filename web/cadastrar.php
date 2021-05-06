<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/connect.php";


         
?>
<!DOCTYPE>
<html>
    <header>
            <title>Cadastro</title>
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
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </header>
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
            function sucesso() {
                var txt;
                if (confirm("Usuário criado com sucesso! Fazer login?")) {
                    window.location.href = "login.php";
                } else {
                    
                }
               
            }
            function email() {
                alert("Email já cadastrado!")
               
            }
            function senhas() {
                alert("Senha e confirmar senha não são a mesma!")
               
            }
            function campos() {
                alert("Preencha todos os campos!")
               
            }
    </script>

<body >
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
        <center>
    <div id="corpo-cadastro">
        
        <h4>Cadastro de Usuários</h4>
                    
            <form enctype="multipart/form-data" method="post" action="">
                    
                <label for="cars">Opção de Cadastro</label>
                <select name="tipo_usuario" id="tipo_usuario">
                <option value="1">Aluno</option>
                <option value="2" id="mais">Professor</option>
                <option value="3" id="mais">Geógrafo</option>
                </select>
                   <p></p>
                   <input  class="form-control" type="text" name="nome" placeholder="Nome Completo" />
                   <p></p>
                   <input  class="form-control" type="email" name="email" placeholder="Email" maxlength="120">
                   <p></p>
                   <input  class="form-control" type="password" name="senha" placeholder="Senha" maxlength="20">
                   <p></p>
                   <input  class="form-control" type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="20"> 
                   <p></p>
                   <input  class="form-control" type="text" name="instituicao" placeholder="Instituição" maxlength="120"> 
                   <p></p>
                   <select class="form-control" placeholder="estados" name="estados" id="estados">
                       <option value=""></option>
                   </select>
                    <p></p>
                    <select class="form-control" placeholder="municipio" name="cidades" id="cidades">
                       <option value=""></option>
                   </select>
                    <p></p>           
                        <input type="submit" name ="submit" class="btn_cadastro"  value="CADASTRAR">
                    </div>
                <br>
                
            </form>
            
    </div>
    </center>
 <?php   
if(isset($_POST['nome']))
{
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $confirmarSenha = $_POST['confSenha'];
  $instituicao = $_POST['instituicao'];
  $estado = $_POST['estados'];
  $cidade = $_POST['cidades'];
  $tipo = $_POST['tipo_usuario'];
  //verificar se todos os campos foram preenchidos
  if(!empty($nome) && !empty($instituicao) && !empty($email) && !empty($senha) && !empty($confirmarSenha) && !empty($estado) && !empty($cidade)){
    
     // if($u->mgsErro == ''){
      if ($senha == $confirmarSenha) {


        $verfi_email = pg_query($dbcon, "SELECT id FROM usuario WHERE email = '".$email."'");
        
        if( pg_num_rows($verfi_email) == 0){
            $insertcidades =  pg_query($dbcon, "INSERT INTO cidades VALUES(default, '".$cidade."','".$estado."');");
        
            if($insertcidades){
                $id_cidade = pg_query($dbcon, "SELECT id FROM cidades ORDER BY id DESC LIMIT 1");
                if($id_cidade){
                    while ($resultado_city = pg_fetch_array($id_cidade)) {
                        $id_city = $resultado_city["id"];
                    }
                    $insertinstituicao = pg_query($dbcon, "INSERT INTO instituicao VALUES(default, '".$instituicao."','".$id_city."');");
                    if($insertinstituicao){
                        $id_instituicao = pg_query($dbcon, "SELECT id FROM instituicao ORDER BY id DESC LIMIT 1");
                        if($id_instituicao){
                            while ($resultado_inst = pg_fetch_array($id_instituicao)) {
                                $id_inst = $resultado_inst["id"];
                            }
                            $insertusuario = pg_query($dbcon, "INSERT INTO usuario VALUES(default, '".$nome."','".$email."','".$senha."','".$tipo."','".$id_inst."');");
                            if($insertusuario){
                                echo '<script>sucesso();</script>';
                            }
                            
                        }

                    }
                }
            }
        }else{
            echo '<script>email();</script>';
        }

      }else{
        echo '<script>senhas();</script>';
      }
   

}else{
    echo '<script>campos();</script>';
}
}
?>
          
</body>
</html>
