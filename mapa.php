<?php
?>
<!DOCTYPE html>
<html>
  <head>
   
   <title>Mapa</title>
   <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/styles.css"/>
            <script language="javascript" src="javascript/funcoes.js"></script>
  </head>
  <body>
   <center> <canvas width="1100" height="650"></canvas> </center>

  </body>
   <script type="text/javascript">
  var LEFT = 37, UP = 38, RIGHT = 39, DOWN = 40, PGUP = 33, PGDOWN = 34;
  var mvLeft = false, mvRight = false, mvUp = false, mvDown = false, zoomIn = false, zoomOut = false;
  var cnv = document.querySelector("canvas");
  var ctx = cnv.getContext("2d");
  var X = 0;
  var Y = 0;
  var size = 400;
  var speed = 2;
  var map = new Image();
  map.src = "upload/mapatemp.png";
  map.onload = looping();

  window.addEventListener("keydown",keydownHandler,false);
  window.addEventListener("keyup",keyupHandler,false);

  function keydownHandler(e){//função disparada quando uma tecla é pressionada
    var key = e.keyCode;
    switch(key){
      case LEFT:
        mvLeft = true;
        break;
      case RIGHT:
        mvRight = true;
        break;
      case UP:
        mvUp = true;
        break;
      case DOWN:
        mvDown = true;
        break;
      case PGDOWN:
        zoomOut = true;
        break;
      case PGUP:
        zoomIn = true;
        break;
    }
  }

  function keyupHandler(e){//função disparada quando uma tecla é liberada
    var key = e.keyCode;
    switch(key){
      case LEFT:
        mvLeft = false;
        break;
      case RIGHT:
        mvRight = false;
        break;
      case UP:
        mvUp = false;
        break;
      case DOWN:
        mvDown = false;
        break;
      case PGDOWN:
        zoomOut = false;
        break;
      case PGUP:
        zoomIn = false;
        break;
    }
  }

  function render(){
    ctx.clearRect(0,0,cnv.width,cnv.height);
    ctx.drawImage(map,X,Y,size,size,0,0,cnv.width,cnv.height);
  }

  function update(){
    if(mvLeft){
      if(X > speed){
        X -= speed;
      }
    }
    if(mvRight){
      if(X + size < map.width - speed){
        X += speed;
      }
    }
    if(mvUp){
      if(Y > speed){
        Y -= speed;
      }
    }
    if(mvDown){
      if(Y + size < map.height - speed){
        Y += speed;
      }
    }
    if(zoomIn){
      size -= speed;
    }
    if(zoomOut){
      size += speed;
    }
  }

  function looping(){//função que se repete 60x por segundo
    requestAnimationFrame(looping,cnv);
    update();//processa a interação
    render();//desenha o mapa atualizado na tela
  }
</script>
</html>
