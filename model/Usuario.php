<?php
class Usuario
{
    //atributos 
    private $codigo_usuario;
    private $nome_usuario;
    private $email;
    private $senha;
    private $cpf;
    private $telefone;
    private $estado;
    private $cidade;
    private $rua;
    private $bairro;
    private $cep;

    /* codigo_usuario	nome_usuario	email	senha	cpf	telefone	estado	cidade	rua	bairro	cep	*/

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
        $cmd = $con->prepare("INSERT INTO usuario 
        (nome_usuario, email, senha, cpf, telefone, estado, cidade, rua, bairro, cep) 
        VALUES (:nome_usuario, :email, :senha, :cpf, :telefone, :estado, :cidade, :rua, :bairro, :cep)");

        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_usuario",    $this->nome_usuario);
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


    function logar_usuario(){
        $con = Conexao::conectar();
        $cmd = $con->prepare("SELECT * FROM usuario where email = :email AND senha = :senha");
        $cmd->bindParam(":email", $this->email);
        $cmd->bindParam(":senha", $this->senha);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }

    //método consultar 
    function consultar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM usuario");
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_OBJ); //retorna os dados em forma de matriz
    }

    //método excluir -> revisar quando a tela de login efetuado estiver pronta
    function excluir()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("DELETE FROM usuario WHERE codigo_usuario = :codigo_usuario "); //enviando valor para o parâmetro
        $cmd->bindParam(":codigo_usuario", $this->codigo_usuario); //valor do parâmetro
        $cmd->execute(); //executando o comando
    }

    //método atualizar -> revisar quando a tela de login efetuado estiver pronta
    function atualizar()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("UPDATE usuario SET
            nome_usuario    = :nome_usuario, 
            email       = :email, 
            senha       = :senha, 
            cpf         = :cpf,
            telefone    = :telefone,
            cidade      = :cidade,
            estado      = :estado,
            rua         = :rua,
            bairro      = :bairro,
            cep         = :cep


        WHERE codigo_usuario = :codigo_usuario");
        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_usuario",    $this->nome_usuario);
        $cmd->bindParam(":email",   $this->email);
        $cmd->bindParam(":senha",   $this->senha);
        $cmd->bindParam(":cpf",  $this->cpf);
        $cmd->bindParam(":telefone", $this->telefone);
        $cmd->bindParam(":estado",   $this->estado);
        $cmd->bindParam(":cidade",   $this->cidade);
        $cmd->bindParam(":codigo_usuario",  $this->codigo_usuario);

        $cmd->execute();//executando o comando
    }

    //método retornar
    function retornar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM usuario 
        WHERE codigo_usuario = :codigo_usuario");
        $cmd->bindParam(":cadrastousuario", $this->codigo_usuario);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ); //retorna os dados em forma de vetor
    }

  
    

}
?>