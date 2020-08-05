<?php
    require_once ("CLASSES/usuario.php"); 
    include_once 'CLASSES/usuario.php';
    require_once 'CLASSES/usuario.php';
     $u = new Usuario;


      $u->conectar("atlas","localhost","ricardo","123");

          $sql = "SELECT * from mapas";

          $consulta = $pdo->query($sql);

          While($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
            $album[] = $linha;
              # code...
            }
          
?>

<!DOCTYPE>
<html>
    <header>
            <title>Atlas</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    </header>

<body id="atlas">

    <div id="mapas">

      <?php
      
          foreach ($album as $foto) {
            # code...
          ?>
      <!-- <table> -->
       <center>
        <!-- <tr> -->
          
          <!--  <center> -->
         <!--  <td> -->
            <img src="<?php echo "./upload/".$foto["arquivo"]?> " width="260" height="200"/>
          <!-- </td> -->
         <!--  </center> -->
        <!-- </tr> -->
      </center>
     <!--  </table>       -->
        <?php
          }

        ?><br>
        
    </div>
</body>
</html>