<?php

namespace App\Language\PT;


class Language {



    public static function notFoundController ($controller = null) 
    {
        if(is_null($controller)){
            return "Não foi possivel localizar o controllador.";
        }

        return "Controlador {$controller} não encontrado.";
    }

    public static function notFoundClass ($class = null) 
    {
        if(is_null($class)){
            return "Não foi possivel localizar a classe.";
        }

        return "Classe {$class} não encontrada.";
    }

    public static function notFoundMethod ($controller = null, $method = null)
    {
        if(is_null($controller)){
            return "Não foi possivel localizar o method.";
        }

        return "O metodo {$controller}::{$method} não encontrado.";
    }

    public static function pageNoDisponible()
    {
        return "Não foi possivel processar o seu pedido!";
    }


}