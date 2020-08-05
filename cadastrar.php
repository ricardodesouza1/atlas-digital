<?php
    require_once ("CLASSES/usuario.php"); 
    include_once 'CLASSES/usuario.php';
    require_once 'CLASSES/usuario.php';
     $u = new Usuario;
?>
<!DOCTYPE>
<html>
    <header>
            <title>Cadastro</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    </header>

<body id="login">

    <div id="corpo-cadastro">
        <center>
        <h1>Cadastrar</h1>
        <form method="post">
                   <input type="text" name="nome" placeholder="Nome Completo" maxlength="80">
                   <input type="text"  name="telefone" placeholder="Telefone" maxlength="30">
                   <input type="email" name="email" placeholder="Email" maxlength="40">
                   <input type="password" name="senha" placeholder="Senha" maxlength="15">
                   <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15"> 
                   <input type="submit" value="CADASTRAR">
        </form>
        </center>
    </div>
 <?php   
// verificar a uma cadstro
if(isset($_POST['nome']))
{
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $confirmarSenha = $_POST['confSenha'];
  //verificar se todos os campos foram preenchidos
  if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){
      $u->conectar("atlas","localhost","ricardo","123");

      if($u->mgsErro == ""){
      if ($senha == $confirmarSenha) {

        if($u->cadastrar($nome, $telefone, $email, $senha)){
          ?>
              <center>
              <div id="msg_certo">
              Cadastrado com sucesso!
              <a href="login.php"><strong>Logar</strong></a>

              </div>
              </center>
          <?php
        }else{
          ?>
              <center>
              <div class="msg_erro">
              Email já cadastrado!
              </div>
              </center>
          <?php
          
        }

      }else{
          ?>
              <center>
              <div class="msg_erro">
              Senha e confirmar senha não são a mesma!
              </div>
              </center>
          <?php
      

      }
    }else{
          ?>
              <center>
              <div class="msg_erro">
              <?php echo "Erro: ".$u->msgErro; ?>
              </div>
              </center>
          <?php
      
    }

}else{
          ?>
              <center>
              <div class="msg_erro">
              Preencha todos os campos!
              </div>
              </center>
          <?php



  // parte 4 15:13 minutos continuar
}
}
?>
          

</body>
</html>