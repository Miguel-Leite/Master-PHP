<?php


namespace Master\Router;

use App\Language\PT\Language;
use Exception;
use Master\Core\Controller;

/**
 * Router
 */
class Router {
    
    /**
     * uri
     *
     * @var mixed
     */
    private $uri;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct( )
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); 
        $uri = explode('/',ltrim($this->uri,'/'));
        array_shift($uri);
        $this->uri = "/".implode('/',$uri);  
    }

    
    /**
     * Method exactMatchUri
     * 
     * EXACT MATCH URI IN ARRAY ROUTERS
     *
     * @param $uri $uri [explicite description]
     * $routes $routes [explicite description]
     *
     * @return array
     */
    public function exactMatchUri($uri, $routes):array
    {
        if(array_key_exists($uri,$routes))
        {
            return [$uri => $routes[$uri]];
        }

        return [];
    }

    
    /**
     * Method regexMatchRoutes
     * 
     * MATCH URI DINAMIC
     *
     *  $uri $uri [explicite description]
     *  $routes $routes [explicite description]
     *
     * @return array
     */
    public function regexMatchRoutes($uri,array $routes):array
    {
        return array_filter($routes,function($value) use ($uri){
                $regex = str_replace('/','\/',ltrim($value,'/'));
                return preg_match("/^$regex$/",ltrim($uri,'/'));
            },ARRAY_FILTER_USE_KEY);   
    }

    
    /**
     * Method params
     * 
     * MATCH PARAM URI DINAMIC
     *
     * $uri $uri [explicite description]
     * $matchedUri $matchedUri [explicite description]
     *
     * @return array
     */
    public function params($uri,$matchedUri):array
    {
        if(!empty($matchedUri)){

            $matchedToGetParams = array_keys($matchedUri)[0];

            return array_diff(
                $uri,
                explode('/',ltrim($matchedToGetParams,'/'))
            );
            
        }
        return [];
    }

    
    /**
     * Method paramsFormat
     * 
     * FORMATING PARAMS
     *
     * $uri $uri [explicite description]
     * $params $params [explicite description]
     *
     * @return array
     */
    public function paramsFormat($uri,$params):array
    {

        $paramsData = [];
        foreach ($params as $index => $param) {
            $paramsData[$uri[$index - 1]] = $param;
        }

        return $paramsData;

    }    
    /**
     * Method router
     *
     * @return void
     */
    public function router()
    {   
        $uri = $this->uri;
        $routes = setRouters()["ROUTERS"];
        
        

        $matchedUri = $this->exactMatchUri($uri,$routes);

        $params = [];

        if (empty($matchedUri)){

            $matchedUri = $this->regexMatchRoutes($uri,$routes);
            

            if(!empty($matchedUri)){
                $uri = explode('/',ltrim($uri,'/'));
                $params = $this->params($uri,$matchedUri);
            }

        }


        if(!empty($matchedUri))
        {
            Controller::loadController($matchedUri,$params);
            return;
        }

        throw new Exception(Controller::ExceptionView("ExceptionView",[
            "title" => "Page no disponible", 
            "message" => Language::pageNoDisponible()])
        );
    }

}