<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javascript</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/base.css">

</head>
<body>
<audio id="music" class="audio" autoplay loop>
  <source type="audio/mp3" src="audio/fondo.mp3">
</audio>    
<header class="header align-middle justify-content-center">
<img src="./images/js_dom.jpeg">
<h1>Akinator Fullstack</h1>
</header>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
<div class="container">  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?n=1&r=0">Volver a jugar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datos.php">Estadísticas</a>
      </li>
    </ul>
  </div>
  <a class="navbar-brand" href="#">
    <img src="images/svg/sound-on.svg" data-state="on">
  </a>
</div>
</nav>
