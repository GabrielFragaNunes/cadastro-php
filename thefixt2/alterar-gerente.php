<?php
session_start();
ob_start();
include_once 'util/helper.class.php';

if(isset($_GET['id'])){
  include_once "dao/gerentedao.class.php";
  include_once "modelo/gerente.class.php";
  $ge = new GerenteDAO();
  $array = $ge->filtrar($_GET['id'],"codigo");
  // var_dump($array); //só teste
  $ge = $array[0];
  // echo $ge; //toString
}else{
  header("location:consulta-gerentes.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title class="title">Edição de gerentes</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script> src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script> src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Edição de gerentes</h1>

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
            <input type="text" name="txtnome" placeholder="Nome" class="form-control" value="<?php if(isset($ge)){echo $ge->nomege; }?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtprojeto" placeholder="Projeto " class="form-control" value="<?php if(isset($ge)){echo $ge->projresp; }?>">
          </div>
          <div class="form-group">
            <input type="number" name="numidade" placeholder="Idade" class="form-control" value="<?php if(isset($ge)){echo $ge->idadege; }?>">
          </div>
          <div class="form-group">
            <input type="number" name="numsalario" placeholder="Salário" class="form-control" value="<?php if(isset($ge)){echo $ge->salarioge; }?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtemail" placeholder="Email" class="form-control" value="<?php if(isset($ge)){echo $ge->emailge; }?>">
          </div>
          <div class="form-group">
            <input type="number" name="numtel" placeholder="Telefone" class="form-control" value="<?php if(isset($ge)){echo $ge->telefonege; }?>">
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['alterar'])){
            include_once 'modelo/gerente.class.php';
            include_once 'dao/gerentedao.class.php';
            include 'util/padronizacao.class.php';

            $ge = new Gerente();
            $ge->idGerente= $_GET['id'];
            $ge->nomege = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $ge->projresp = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtprojeto']));
            $ge->idadege = ($_POST['numidade']);
            $ge->salarioge = $_POST['numsalario'];
            $ge->emailge = Padronizacao::antiXSS(Padronizacao::padronizarMin($_POST['txtemail']));
            $ge->telefonege = $_POST['numtel'];

            $geDAO = new GerenteDao();
            $geDAO->alterarGe($ge);
            $_SESSION['msg'] = "Gerente alterado com sucesso!";
            header("location:cadastro-gerente.php");
            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
