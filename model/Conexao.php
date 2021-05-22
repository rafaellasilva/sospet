<?php

    class Conexao
    {

        //método static não precisa instanciar
        static function Conectar()
        {
            //servidor, nome do banco, usuario e senha
            //se alguém usar o usbwebserver, é só colocar a senha dentro das ultimas aspas

            $con = new PDO("mysql:host=localhost;dbname=dbsospet", "root", ""); //iniciando o pdo/ passando parâmetros

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //:: indica um atributo static dentro do PDO

            return $con; //retornando a conexão ao banco C:
        }
    }


?>