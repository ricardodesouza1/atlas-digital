<?php


$c = mysqli_connect("localhost", "ricardo", "123", "atlas");

 $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  


mysqli_query($c, "insert into usuarios (nome, telefone, email, senha) Values ('$nome','$telefone','$email','$senha')");