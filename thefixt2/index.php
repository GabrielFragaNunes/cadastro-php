<?php session_start();
ob_start();
include_once 'util/helper.class.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
  <div class="container">
    <div class="banner">
      <img class="banner-site" src="img/fundo-tf.png">
    </div>


    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
      <a class="navbar-brand" href="index.php">Sistema</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-dev.php">Cad. Devs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-gerente.php">Cad. Gerentes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-proj.php">Cad. Projetos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-devs.php">Cons. Devs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-gerentes.php">Cons. Gerentes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-projs.php">Cons. Projetos</a>
          </li>
        </ul>
      </div>
    </nav>

    <h2 class="bemvindo">Bem vindo ao sistema de cadastro The Fixt!</h2>
  </div>
</body>
</html>
