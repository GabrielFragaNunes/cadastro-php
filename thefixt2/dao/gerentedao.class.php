<?php
require 'conexaobanco.class.php';
 class GerenteDAO {
   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarGerente($ge){
     try{
        $stat=$this->conexao->prepare("insert into gerente
                                    (idGerente,nomege,idadege,projresp,salarioge,telefonege,emailge)
                                    values(null,?,?,?,?,?,?)");
       $stat->bindValue(1, $ge->nomege);
       $stat->bindValue(2, $ge->idadege);
       $stat->bindValue(3, $ge->$projresp);
       $stat->bindValue(4, $ge->salarioge);
       $stat->bindValue(5, $ge->telefonege);
       $stat->bindValue(6, $ge->emailge);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }
   }

   public function buscarGe(){
     try{
       $stat = $this->conexao->query("select * from gerente");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Gerente');
       return $array;
       echo "Erro ao buscar gerentes! ".$e;
     }catch(PDOException $e){
     }
   }
   //
   public function filtrar($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos": $query = "";
         break;

         case "id": $query = "where idGerente = ".$pesquisa;
         break;

         case "nome": $query = "where nomege like '%".$pesquisa."%'";
         break;

         case "projeto": $query = "where projetoresp like '%".$pesquisa."%'";
         break;

         case "salario": $query = "where salarioge like '%".$pesquisa."%'";
         break;

         case "idade": $query = "where idadege like '%".$pesquisa."%'";
         break;

         case "email": $query = "where emailge like '%".$pesquisa."%'";
         break;

         case "telefone": $query = "where telefonege like '%".$pesquisa."%'";
         break;
       }

       $stat = $this->conexao->query("select * from gerente {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Gerente');
       return $array;

     }catch(PDOException $e){
       echo "Erro ao filtrar gerentes. ".$e;
     }
   }

   public function alterarGe($ge){
     try{
       $stat = $this->conexao->prepare("update desenvolvedor set nomege=?, idadege=?, projresp=?, salarioge=?, telefonege=?, emailge=? where idGerente=?");
       $stat->bindValue(1, $ge->nomege);
       $stat->bindValue(2, $ge->idadege);
       $stat->bindValue(3, $ge->projresp);
       $stat->bindValue(4, $ge->salarioge);
       $stat->bindValue(5, $ge->telefonege);
       $stat->bindValue(6, $ge->emailge);
       $stat->bindValue(7, $ge->idGerente);
       $stat->execute();

     }catch(PDOException $e){
       echo "Erro ao alterar Dev! ".$e;
     }
   }

   public function deletarGe($idGerente){
     try{
       $stat = $this->conexao->prepare("delete from gerente where idGerente = ?");
       $stat->bindValue(1, $idGerente);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao excluir gerente! ".$e;
     }
   }
 }
