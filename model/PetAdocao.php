<?php
class Ong
{
    //atributos 
    private $codigo_doacao_ong
    private $nome_pet;
    private $estado;
    private $cidade;
    private $observacoes;
    private $fk_codigo_ong; 
 

    //get e set 
    function __get($atributo) { return $this->$atributo; }
    function __set($atributo, $valor) { $this->$atributo = $valor; }


    //Atributo = banco de dados / valor = inserido pelo usuário

    function __construct() //será executado automaticamente ao usar esta classe
    {
        include_once "Conexao.php"; //incluindo classe de conexão
    }


    //método cadastrar
    function cadastrar()
    {  
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("INSERT INTO adocao_ong
        (nome_pet, estado, cidade, observacoes, fk_codigo_ong) 
        VALUES (:nome_pet, :estado, :cidade, :observacoes, :fk_codigo_ong)");

        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_pet",     $this->nome_pet);
        $cmd->bindParam(":estado",    $this->estado);
        $cmd->bindParam(":cidade",    $this->cidade);
        $cmd->bindParam(":observacoes",      $this->observacoes);
        $cmd->bindParam(":fk_codigo_ong", $this->fk_codigo_ong);

        $cmd->execute();//executando o comando
    }

    //método consultar 
    function consultar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM adocao_ong");
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_OBJ); //retorna os dados em forma de matriz
    }

    //método excluir -> revisar quando a tela de login efetuado estiver pronta
    function excluir()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("DELETE FROM adocao_ong WHERE codigo_doacao_ong = :codigo_doacao_ong "); //enviando valor para o parâmetro
        $cmd->bindParam(":codigo_doacao_ong", $this->codigo_doacao_ong); //valor do parâmetro
        $cmd->execute(); //executando o comando
    }

    //método atualizar -> revisar quando a tela de login efetuado estiver pronta
    function atualizar()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("UPDATE adocao_ong SET
            nome_pet    = :nome_pet, 
            estado   = :estado, 
            cidade   = :cidade, 
            observacoes     = :observacoes,
            fk_codigo_ong = :fk_codigo_ong
           

        WHERE codigo_doacao_ong = :codigo_doacao_ong");
        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_pet",    $this->nome_pet);
        $cmd->bindParam(":estado",   $this->estado);
        $cmd->bindParam(":cidade",   $this->cidade);
        $cmd->bindParam(":observacoes",  $this->observacoes);
        $cmd->bindParam(":fk_codigo_ong", $this->fk_codigo_ong);

        $cmd->execute();//executando o comando
    }

    //método retornar
    function retornar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM adocao_ong
        WHERE codigo_doacao_ong = :codigo_doacao_ong");
        $cmd->bindParam(":cadrastoong", $this->codigo_doacao_ongs); // atenção aqui pois não sabemos oq por no cadrastoong 
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ); //retorna os dados em forma de vetor
    }

  /*  //método para logar não precisa nesse caso mas eatá aqui, caso necessário
    function logar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM desaparecidos
        WHERE email = :email AND senha = :senha");
        $cmd->bindParam(":email", $this->email);
        $cmd->bindParam(":senha", $this->senha);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ); //retorna os dados em forma de vetor
    } */ 

}
?>