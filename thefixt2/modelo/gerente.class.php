<?php
Class Gerente{
  private $nomege;
  private $idadege;
  private $projresp;
  private $salarioge;
  private $telefonege;
  private $emailge;
  private $idGerente;

  public function __construt(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("
                  Nome: $this->nomege
                  Idade: $this->$idadege
                  Projeto: $this->$projresp
                  Salário: $this->salarioge
                  Telefone: $this->telefonege
                  Email: $this->emailge");
  }
}
