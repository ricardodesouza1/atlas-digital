<?php
    require_once ("CLASSES/usuario.php"); 
    include_once 'CLASSES/usuario.php';
    require_once 'CLASSES/usuario.php';
     $u = new Usuario;
?>

<!DOCTYPE>
<html>
    <header>
            <title>Login</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    </header>

<body id="login">

    <div id="corpo-form">
        <center>
        <h1>Entrar</h1>
        <form method="POST">
                   <input type="email" name="email" placeholder="Email de Usuário">
                   <input type="password" name="senha" placeholder="Senha">
                   <input type="submit" value="ACESSAR" id="botaol">
                   <a href="cadastrar.php">Ainda ná é inscrito?<strong>Cadastre-se!</strong>
                   </a>
        </form>
        </center>
    </div>
<?php
if(isset($_POST['email']))
{
  
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  //verificar se todos os campos foram preenchidos
  if(!empty($email) && !empty($senha)){
    $u->conectar("atlas","localhost","ricardo","123");

      if($u->mgsErro == ""){
        if($u->logar($email,$senha)){
          header("location: upload.php");
        }else{

          ?>
          <center>
              <div class="msg_erro">
              Email ou senha incorretos!
              </div>
          </center>

          <?php

          
        }

      }else{
          ?>
          <center>
              <div class="msg_erro">
          <?php "Erro: ".$u->mgsErro; ?>
              </div>
          </center>

          <?php
      }
  }else{
    ?>
          <center>
              <div class="msg_erro">
              Prencha todos os campos!
              </div>
          </center>

          <?php

    
  }
}
?>
          

</body>
</html>