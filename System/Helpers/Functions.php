<?php

use Master\Helpers\Flash;
use Master\Helpers\Load;
use Master\Helpers\Redirect;
use Master\Traits\Text;



/**
 * Method makeHelper
 *
 * @return void
 */
function makeHelper()
{

    $helpers = require_once 'App/Config/Helpers.php';

    foreach ($helpers as $helper) {
        
        require_once PROJECT_PATH . "App/Helpers/" . $helper. ".php";

    }

}



/**
 * Method load_helper_functions
 *
 * @param $load $load [explicite description]
 *
 * @return void
 */
function load_helper_functions(string $load)
{
    $helper = ucfirst($load);
    if (file_exists(PROJECT_PATH . "System/Helpers/functions/{$helper}.php"))
    {
        require_once PROJECT_PATH . "System/Helpers/functions/{$helper}.php";
    }


}

/**
 * Method load_validation_functions
 *
 * @param $load $load [explicite description]
 *
 * @return void
 */
function load_validation_functions(string $load)
{
    $helper = ucfirst($load);
    if (file_exists(PROJECT_PATH . "System/Validation/functions/{$helper}.php"))
    {
        require_once PROJECT_PATH . "System/Validation/functions/{$helper}.php";
    }


}

/**
 * Method dump
 *
 * @param $debug $debug [explicite description]
 *
 * @return string
 */
function dump($debug):string | array
{
    var_dump($debug);die;
}

/**
 * Method abridgeText
 *
 * @param string $text [explicite description]
 * @param int $limit [explicite description]
 * @param $continue $continue [explicite description]
 *
 * @return string
 */
function abridgeText(string $text, int $limit, $continue = null):string
{
    return Text::abridgeText($text,$limit,$continue);
}

/**
 * Method redirect
 *
 * @param $to $to [explicite description]
 *
 * @return void
 */

 
/**
 * Method redirect
 *
 * @param $to $to [explicite description]
 *
 * @return void
 */
function redirect($to)
{

    return Redirect::to($to);

}


/**
 * Method base_url
 *
 * @param $url=null $url [explicite description]
 *
 * @return void
 */
function base_url($url=null)
{
    $app = (object) App();
    $base =  (empty($app->BASE_URL)) ? dirname(__FILE__,3) . DIRECTORY_SEPARATOR : $app->BASE_URL.$url;
    
    if(!empty($url)) {
        $base_url = rtrim($base,'/') . "/" . $url;
        return $base_url;
    }
    
    return $base_url = rtrim($base,'/') . '/';
}


/**
 * Method view
 *
 * @param string $view [explicite description]
 * @param $data $data [explicite description]
 *
 * @return void
 */
function view(string $view, $data = [])
{
    $data["base_url"] = base_url();
    extract($data);   
    
    $file = PROJECT_PATH . "/App/Views/{$view}.php";

    if (file_exists($file))
    {
        require_once $file;
    } else {
        throw new Exception("View {$view}.php não encontrada");
    }
}


/**
 * Method link_html
 *
 * @param $link $link [explicite description]
 *
 * @return void
 */
function link_html($link)
{
    $file = PROJECT_PATH . "/public/{$link}.css";

    if (file_exists($file))
    {
        return $file;
    } 
}


/**
 * Method getMessage
 *
 * @param $index $index [explicite description]
 *
 * @return void
 */
function getMessage($index)
{
    return Flash::getFlash($index);
}



/**
 * 
 * VALIDATOR
 * 
 */

function getError($index)
{
    return Flash::getFlash($index);
}
