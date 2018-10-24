<?php
require 'conexaobanco.class.php';
 class DevDAO {
   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarDev($dev){
     try{
       $stat=$this->conexao->prepare("insert into desenvolvedor
                                    (idDev,nomedev,projetodev,salariodev,idadedev,emaildev,tipodev)
                                    values(null,?,?,?,?,?,?)");
       $stat->bindValue(1, $dev->nomedev);
       $stat->bindValue(2, $dev->projetodev);
       $stat->bindValue(3, $dev->salariodev);
       $stat->bindValue(4, $dev->idadedev);
       $stat->bindValue(5, $dev->emaildev);
       $stat->bindValue(6, $dev->tipodev);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }
   }

   public function buscarDev(){
     try{
       $stat = $this->conexao->query("select * from desenvolvedor");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Dev');
       return $array;
       echo "Erro ao buscar desenvolvedores! ".$e;
     }catch(PDOException $e){
     }
   }

   public function filtrar($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos": $query = "";
         break;

         case "id": $query = "where idDev = ".$pesquisa;
         break;

         case "nome": $query = "where nomedev like '%".$pesquisa."%'";
         break;

         case "projeto": $query = "where projetodev like '%".$pesquisa."%'";
         break;

         case "salario": $query = "where salariodev like '%".$pesquisa."%'";
         break;

         case "idade": $query = "where idadedev like '%".$pesquisa."%'";
         break;

         case "email": $query = "where emaildev like '%".$pesquisa."%'";
         break;

         case "tipo": $query = "where tipodev like '%".$pesquisa."%'";
         break;
       }

       $stat = $this->conexao->query("select * from desenvolvedor {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Dev');
       return $array;

     }catch(PDOException $e){
       echo "Erro ao filtrar devs. ".$e;
     }
   }

   public function alterarDev($dev){
     try{
       $stat = $this->conexao->prepare("update desenvolvedor set nomedev=?, projetodev=?, salariodev=?, idadedev=?, emaildev=?, tipodev=? where idDev=?");
       $stat->bindValue(1, $dev->nomedev);
       $stat->bindValue(2, $dev->projetodev);
       $stat->bindValue(3, $dev->salariodev);
       $stat->bindValue(4, $dev->idadedev);
       $stat->bindValue(5, $dev->emaildev);
       $stat->bindValue(6, $dev->tipodev);
       $stat->bindValue(7, $dev->idDev);
       $stat->execute();

     }catch(PDOException $e){
       echo "Erro ao alterar Dev! ".$e;
     }
   }

   public function deletarDev($idDev){
     try{
       $stat = $this->conexao->prepare("delete from desenvolvedor where idDev = ?");
       $stat->bindValue(1, $idDev);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao excluir dev! ".$e;
     }
   }
 }
