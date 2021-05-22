<?php

    class LoginController
    {
        function abrir_logins()
        {
            include_once "view/login/Logins.php";
        }

        function logar(){

            if($_POST["opcao"] == "ong"){

                include "model/Ong.php";
            }
            else if($_POST["opcao"] == "usuario"){ //Caso logue como um usuário
                
                include_once "model/Usuario.php";
                $usu = new Usuario();

                $usu->email = $_POST["email"];
                $usu->senha = $_POST["senha"];
                $dados= $usu->logar_usuario(); //Dados recebe o que o método traz

                if(empty($dados))
                {
                    echo "<script> alert('Você precisa preencher os campos email e senha');
                    window.location='index.php?classe=LoginController&metodo=abrir_logins';</script>"; //Não-Preenchido
                }
                else{
                    header("location:index.php?classe=CentralController&metodo=abrir_central"); //Logado
                }
            }
            else if(!isset($_POST["opcao"])){
                echo "<script>
                alert('Você precisa escolher uma opção');
                window.location='index.php?classe=LoginController&metodo=abrir_logins'; 
            </script>";
            }
        }
    }


?>