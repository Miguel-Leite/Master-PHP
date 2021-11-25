<?php


namespace Master\Helpers;

use App\Language\PT\Language;
use Master\Core\Controller;

/**
 * Load
 */
class Load
{

    static $config;

    
    /**
     * Method database
     *
     * @param $index $index [explicite description]
     *
     * @return void
     */
    public static function database($index)
    {
        static::$config = require_once PROJECT_PATH . "App/Config/Database.php";

        if (!isset(static::$config[$index]))
        {

            throw new \Exception(Controller::ExceptionView("ExceptionView",[
                "message" => "Database default {$index} não existe, na classe Load",
                "title" => "Not found database default"
            ]));

        }

        return (object) static::$config[$index];
    }

}