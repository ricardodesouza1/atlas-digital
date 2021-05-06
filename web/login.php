<?php
  include "includes/connect.php";


?>

<!DOCTYPE>
<html>
    <header>
            <title>Login</title>
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
    </header>
<script>
            function senhas() {
                alert("Email ou senha incorretos!")
               
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
        
        <h4>Entrar</h4>
        <form enctype="multipart/form-data" method="post" action="">
                <div class="modal-body">
                   <input class="form-control"  type="email" name="email" placeholder="Email de Usuário"><br>
                   <input class="form-control"  type="password" name="senha" placeholder="Senha"><br>
                   <input class="btn_cadastro"  type="submit" value="ACESSAR" id="botaol"><br><br>
                   <a href="cadastrar.php">Ainda ná é inscrito?<strong>Cadastre-se!</strong>
                   </a>
                </div>
</form>
    </div>
    </center>   
<?php
if(isset($_POST['email']))
{
  
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  //verificar se todos os campos foram preenchidos
  if(!empty($email) && !empty($senha)){
    $sql = pg_query($dbcon, "SELECT id FROM usuario WHERE email = '".$email."' AND senha = '".$senha."'");
      if(pg_num_rows($sql)>0){
        while ($resultado = pg_fetch_array($sql)) {
          $id = $resultado["id"];
        }
        
        //Controle de Sessão
        session_start();
        $_SESSION["id"]=$id;
        
        header('Location: processa.php?id='.$id.'');
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
