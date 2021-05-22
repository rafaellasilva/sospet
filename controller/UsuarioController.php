<?php
class UsuarioController
{
    function abrir_cadastro()
    {
        //$this->verificar_logado();
        //$this->verificar_acesso();
        include_once "view/cadastro_usuario/CadastroUsuario.php";
    }

    function cadastrar()
    {
        //$this->verificar_logado();
        //$this->verificar_acesso();
        include "model/Usuario.php";
        $usu = new Usuario();

        $usu->nome_usuario     = $_POST["nome_usuario"];
        $usu->email     = $_POST["email"];
        $usu->senha     = hash("sha256",$_POST["senha"]); /* é assim mesmo? não entendi essa parada não */
        $usu->cpf       = $_POST["cpf"];
        $usu->telefone  = $_POST["telefone"];
        $usu->cidade    = $_POST["cidade"];
        $usu->estado    = $_POST["estado"];
        $usu->rua       = $_POST["rua"];
        $usu->bairro    = $_POST["bairro"];
        $usu->cep       = $_POST["cep"];

        $usu->cadastrar();

        echo "<script>
                alert('o seu cadrasto foi concluido com sucesso!');
                window.location='index.php?classe=UsuarioController&metodo=abrir_cadastro';
            </script>";
    }

    function abrir_consulta()
    {
        $this->verificar_logado();
        $this->verificar_acesso();
        include_once "model/usuario.php";
        $usu = new Usuario();
        $dados = $usu->consultar();

        include_once "view/ConsultaUsuario.php"; //carregar a tela de consulta de usuários
    }

    function excluir()
    {
        $this->verificar_logado();
        $this->verificar_acesso();
        include_once "model/usuario.php";
        $usu = new Usuario();
        $usu->codusuario = $_GET["codusuario"];
        $usu->excluir();
        //direcionar para a página de consulta
        header("Location:index.php?classe=UsuarioController&metodo=abrir_consulta");
    }

    function editar()
    {
        $this->verificar_logado();
        $this->verificar_acesso();
        include_once "model/Usuario.php";
        $usu = new Usuario();
        $usu->codusuario = $_GET["codusuario"];
        $dados = $usu->retornar();

        //exibir a tela de edição dos dados
        include_once "view/EditarUsuario.php";
    }

    function atualizar()
    {
        $this->verificar_logado();
        $this->verificar_acesso();
        include "model/Usuario.php";
        $usu = new Usuario();

        $usu->nome      = $_POST["nome"];
        $usu->email     = $_POST["email"];
        $usu->senha     = hash("sha256",$_POST["senha"]);
        $usu->cpf      = $_POST["cpf"];
        $usu->telefone      = $_POST["telefone"];
        $usu->cidade      = $_POST["cidade"];
        $usu->estado    = $_POST["estado"];
        $usu->codusuario    = $_POST["codusuario"];

        $usu->atualizar();

        echo "<script>
                alert('Dados alterados com sucesso!');
                window.location='index.php?classe=UsuarioController&metodo=abrir_consulta';
            </script>";
    }

    function abrir_login()
    {
        include_once "view/login/logins.php";
    }


    function logar()
    {
        include_once "model/Usuario.php";
        $usu = new Usuario();

        $usu->email = $_POST["email"];
        $usu->senha = hash("sha256",$_POST["senha"]);
        $dados = $usu->logar();
        if(empty($dados)) // se os dados ficarem vazio
        {
            echo "<script>
                alert('Usuário ou senha inválido!');
                window.location='index.php?classe=UsuarioController&metodo=abrir_login'; 
            </script>";                                                                         /*atenção aqui se essa parte é assim que nem a dele */
        }
        else
        {
            session_start();//iniciar a sessão
            session_regenerate_id(true);//apaga a sessão antiga
            $_SESSION["cod_logado"]     = $dados->codusuario; //aqui não seria codigo_usuario?
            $_SESSION["nome_logado"]    = $dados->nome; //e aqui nome_usuario?
            $_SESSION["acesso_logado"]  = $dados->acesso;
            //direcionar para a página principal
            header("location:index.php?classe=HomeController&metodo=abrir_home");
        }

    }

    function sair()
    {
        session_start();
        session_destroy();//excluir tudo 
        //unset($_SESSION["cod_logado"]); // exclui apenas uma
        include_once "view/login.php";
    }

    function verificar_logado()
    {
        session_start();
        if(!isset($_SESSION["cod_logado"]))//não existe a sessão
        {
            //voltar para o login
            header("location:index.php?classe=UsuarioController&metodo=abrir_login");
        }
    }

    function verificar_acesso()
    {
        if($_SESSION["acesso_logado"] == 2)//não adm
        {
            //voltar para o início
            header("location:index.php?classe=HomeController&metodo=abrir_home");
        }
    }



}
?>