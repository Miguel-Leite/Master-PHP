<?php


namespace App\Controllers;

use Master\Helpers\Redirect;
use Master\Validation\Validator;

/**
 * BaseController
 */
abstract class BaseController 
{
    
    
    /**
     * requestMethod
     *
     * @var mixed
     */
    public $requestMethod;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        // Validator::require();
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];

    }
    
    /**
     * Method redirectTo
     *
     * @param $to=null $to [explicite description]
     *
     * @return void
     */
    public function redirectTo($to=null)
    {
        return Redirect::to($to);
    }


    
    /**
     * Method redirectBack
     *
     * @param $back=null $back [explicite description]
     *
     * @return void
     */
    public function redirectBack($back=null)
    {
        return Redirect::back($back);
    }

    

}