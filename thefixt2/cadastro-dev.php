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
        <h1 class="jumbotron bg-info" id="title">Cadastro de desenvolvedores</h1>
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
            <input type="text" name="txtnome" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Nome do desenvolvedor" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtprojeto" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Projeto em desenvolvimento" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numidade" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Idade do desenvolvedor" class="form-control">
          </div>
          <div class="form-group">
            <input type="number" name="numsalario" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Salário do desenvolvedor" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="txtemail" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Email do desenvolvedor" class="form-control">
          </div>
          <div class="form-group">
            <select name="seltipo" class="form-control">
              <option value="web">WEB</option>
              <option value="mobile">MOBILE</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['cadastrar'])){
            include 'modelo/dev.class.php';
            include 'dao/devdao.class.php';
            include 'util/padronizacao.class.php';
            include 'util/validacao.class.php';

            $erros = array();

            if(!Validacao::validarNome($_POST['txtnome'])){
              $erros[] = "Nome inválido!";
            }

            $dev = new Dev();
            $dev->nomedev = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $dev->projetodev = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtprojeto']));
            $dev->emaildev = Padronizacao::antiXSS(Padronizacao::padronizarMin($_POST['txtemail']));
            $dev->idadedev = ($_POST['numidade']);
            $dev->salariodev = $_POST['numsalario'];
            $dev->tipodev = Padronizacao::antiXSS($_POST['seltipo']);


            $devDAO = new devDao();
            $devDAO->cadastrarDev($dev);
            $_SESSION['msg'] = "Desenvolvedor cadastrado com sucesso!";
            // header("location:cadastro-dev.php");
            ob_end_flush();
          }
        ?>

      </div>
  </body>
</html>
