<?php

namespace Master\Helpers;

use App\Language\PT\Language;
use Master\Core\Controller;

/**
 * Request
 */
class Request
{
    
    /**
     * Method request
     *
     * @param $type $type [explicite description]
     *
     * @return void
     */
    public static function request (string $type)
    {

        if ( $_SERVER["REQUEST_METHOD"] !=  strtoupper($type))
        {
            throw new \Exception(Controller::ExceptionView("ExceptionView",[
                "message" => "A requisição tem que ser do tipo <b>{$type}</b>.",
                "title" => "Request not found"
            ]));
        }

        return true;

    }
    

}