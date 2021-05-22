<?php

//responsável pelos direcionamentos
    

    if(isset($_REQUEST["classe"]) && isset($_REQUEST["metodo"]))
    {   //existe get ou post classe e método? se sim:
        
        //acessa 
        $classe = $_REQUEST["classe"]; //qual é a classe
        $metodo = $_REQUEST["metodo"];  //qual é o método
    
    include_once "controller/$classe.php"; //abre a classe
    $home = new $classe();
    $home->$metodo(); //abre o método

    }
    else  { include_once "view/Home.php";}

?>