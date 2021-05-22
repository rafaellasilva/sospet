<?php
class Ong
{
    //atributos 
    private $codigo_ong;
    private $nome;
    private $email;
    private $senha;
    private $cpf;
    private $telefone; 
    private $estado;
    private $cidade;
    private $rua;
    private $bairro;
    private $cep;

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
        $cmd = $con->prepare("INSERT INTO ong_doadores
        (nome, email, senha, cpf, telefone, estado, cidade, rua, bairro, cep) 
        VALUES (:nome, :email, :senha, :cpf, :telefone, :estado, :cidade, :rua, :bairro, :cep)");

        //enviando valores para os parâmetros
        $cmd->bindParam(":nome",     $this->nome);
        $cmd->bindParam(":email",    $this->email);
        $cmd->bindParam(":senha",    $this->senha);
        $cmd->bindParam(":cpf",      $this->cpf);
        $cmd->bindParam(":telefone", $this->telefone);
        $cmd->bindParam(":estado",   $this->estado);
        $cmd->bindParam(":cidade",   $this->cidade);
        $cmd->bindParam(":rua",      $this->rua);
        $cmd->bindParam(":bairro",   $this->bairro);
        $cmd->bindParam(":cep",      $this->cep);

        $cmd->execute();//executando o comando
    }

    //método consultar 
    function consultar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM ong_doadores");
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_OBJ); //retorna os dados em forma de matriz
    }

    //método excluir -> revisar quando a tela de login efetuado estiver pronta
    function excluir()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("DELETE FROM ong_doadores WHERE codigo_ong = :codigo_ong "); //enviando valor para o parâmetro
        $cmd->bindParam(":codigo_ong", $this->codigo_ong); //valor do parâmetro
        $cmd->execute(); //executando o comando
    }

    //método atualizar -> revisar quando a tela de login efetuado estiver pronta
    function atualizar()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("UPDATE ong_doadores SET
            nome_ong    = :nome_ong, 
            email   = :email, 
            senha   = :senha, 
            cpf     = :cpf,
            telefone = :telefone,
            cidade    = :cidade,
            estado = :estado


        WHERE codigo_ong = :codigo_ong");
        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_ong",    $this->nome_ong);
        $cmd->bindParam(":email",   $this->email);
        $cmd->bindParam(":senha",   $this->senha);
        $cmd->bindParam(":cpf",  $this->cpf);
        $cmd->bindParam(":telefone", $this->telefone);
        $cmd->bindParam(":estado",   $this->estado);
        $cmd->bindParam(":cidade",   $this->cidade);
        $cmd->bindParam(":codigo_ong",  $this->codigo_ong);

        $cmd->execute();//executando o comando
    }

    //método retornar
    function retornar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM ong_doadores
        WHERE codigo_ong = :codigo_ong");
        $cmd->bindParam(":cadrastoong", $this->codigo_ong);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ); //retorna os dados em forma de vetor
    }

    //método para logar
    function logar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM ong_doadores
        WHERE email = :email AND senha = :senha");
        $cmd->bindParam(":email", $this->email);
        $cmd->bindParam(":senha", $this->senha);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ); //retorna os dados em forma de vetor
    }

}
?>