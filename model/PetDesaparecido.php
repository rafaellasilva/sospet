<?php
class Ong
{
    //atributos 
    private $codigo_desaparecido
    private $nome_desaparecido;
    private $estado;
    private $cidade;
    private $observacoes;
    private $fk_desaparecidos_usuario; 
 

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
        $cmd = $con->prepare("INSERT INTO desaparecidos
        (nome_desaparecido, estado, cidade, observacoes, fk_desaparecidos_usuario) 
        VALUES (:nome_desaparecido, :estado, :cidade, :observacoes, :fk_desaparecidos_usuario)");

        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_desaparecido",     $this->nome_desaparecido);
        $cmd->bindParam(":estado",    $this->estado);
        $cmd->bindParam(":cidade",    $this->cidade);
        $cmd->bindParam(":observacoes",      $this->observacoes);
        $cmd->bindParam(":fk_desaparecidos_usuario", $this->fk_desaparecidos_usuario);

        $cmd->execute();//executando o comando
    }

    //método consultar 
    function consultar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM desaparecidos");
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_OBJ); //retorna os dados em forma de matriz
    }

    //método excluir -> revisar quando a tela de login efetuado estiver pronta
    function excluir()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("DELETE FROM desaparecidos WHERE codigo_desaparecido = :codigo_desaparecido "); //enviando valor para o parâmetro
        $cmd->bindParam(":codigo_desaparecido", $this->codigo_desaparecido); //valor do parâmetro
        $cmd->execute(); //executando o comando
    }

    //método atualizar -> revisar quando a tela de login efetuado estiver pronta
    function atualizar()
    {
        $con = Conexao::conectar(); //carregar a conexão
        $cmd = $con->prepare("UPDATE desaparecidos SET
            nome_desaparecido    = :nome_desaparecido, 
            estado   = :estado, 
            cidade   = :cidade, 
            observacoes     = :observacoes,
            fk_desaparecidos_usuario = :fk_desaparecidos_usuario
           

        WHERE codigo_desaparecido = :codigo_desaparecido");
        //enviando valores para os parâmetros
        $cmd->bindParam(":nome_desaparecido",    $this->nome_desaparecido);
        $cmd->bindParam(":estado",   $this->estado);
        $cmd->bindParam(":cidade",   $this->cidade);
        $cmd->bindParam(":observacoes",  $this->observacoes);
        $cmd->bindParam(":fk_desaparecidos_usuario", $this->fk_desaparecidos_usuario);

        $cmd->execute();//executando o comando
    }

    //método retornar
    function retornar()
    {
        $con = Conexao::conectar();//iniciar conexão com BD
        $cmd = $con->prepare("SELECT * FROM desaparecidos
        WHERE codigo_desaparecido = :codigo_desaparecido");
        $cmd->bindParam(":cadrastoong", $this->codigo_desaparecido); // atenção aqui pois não sabemos oq por no cadrastoong 
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