<?php


namespace Master\Core;

use Exception;
use \App\Language\PT\Language;

/**
 * Controller
 */
class Controller {

    
    /**
     * Method loadController
     *
     * @param $controller $controller [explicite description]
     * @param $params $params [explicite description]
     *
     * @return void
     */
    public static function loadController(array $controller, array $params)
    {

        [$controller,$method] = explode('::',array_values($controller)[0]);
        

        $controllerWithNamespce = NAMESPACE_CONTROLLER.$controller;
       

        if (!file_exists(PROJECT_PATH . "App/Controllers/{$controller}.php")){
            throw new Exception(static::ExceptionView("ExceptionView",[
                "message" => Language::notFoundClass($controller),
                "title" => "Class not found"
            ]));
        }
        
        if (!class_exists($controllerWithNamespce))
        {
            throw new Exception(static::ExceptionView("ExceptionView",[
                "message" => Language::notFoundController($controller),
                "title" => "Class no instance"
            ]));
        }


        $controllerInstance = new $controllerWithNamespce();
        
        if (!method_exists($controllerInstance, $method))
        {   
            throw new Exception(static::ExceptionView("ExceptionView",[
                "message" => Language::notFoundMethod($controller,$method),
                "title" => "Method not found"
            ]));
        }
        call_user_func_array([$controllerInstance,$method],$params);

    }

    
    /**
     * Method ExceptionView
     *
     * @param $view $view [explicite description]
     * @param $data=null $data [explicite description]
     *
     * @return void
     */
    public static function ExceptionView($view, array $data=null)
    {
        extract($data);

        $file = PROJECT_PATH . "System/Page/{$view}.php";

        if (file_exists($file))
        {
            require_once $file;
        }
    }
}