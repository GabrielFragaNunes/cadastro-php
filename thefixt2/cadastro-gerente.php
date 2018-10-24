<?php
session_start();
ob_start();
include_once 'util/helper.class.php';
?>
<!DOCTYPE php>
<html lang="pt-br">
<head>
  <title>Cadastro THE FIXT </title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Cadastro de gerentes</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Sistema</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro-dev.php">Cad. Devs <span class="sr-only">(current)</span></a>
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
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>
        <form name="caddev" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" pattern="[A-zÁ-ü ]{5,50}" placeholder="Nome" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtprojeto" pattern="[A-zÁ-ü ]{2,50}" placeholder="Projeto" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numidade" pattern="[A-zÁ-ü ]{2,50}" placeholder="Idade" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numsalario" pattern="[A-zÁ-ü ]{2,50}" placeholder="Salário" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtemail" pattern="[A-zÁ-ü@ ]{2,50}" placeholder="Email" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numtel" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Telefone" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['cadastrar'])){
            include 'modelo/gerente.class.php';
            include 'dao/gerentedao.class.php';
            include 'util/padronizacao.class.php';

            $ge = new Gerente();
            $ge->nomege = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $ge->projresp = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtprojeto']));
            $ge->idadege = ($_POST['numidade']);
            $ge->salarioge  = $_POST['numsalario'];
            $ge->emailge  = Padronizacao::antiXSS(Padronizacao::padronizarMin($_POST['txtemail']));
            $ge->telefonege  = $_POST['numtel'];

            $geDAO = new GerenteDAO();
            $geDAO->cadastrarGerente($ge);
            $_SESSION['msg'] = "Gerente cadastrado com sucesso!";
            header("location:cadastro-gerente.php");
            ob_end_flush();
          }
        ?>

      </div>
  </body>
</html>
