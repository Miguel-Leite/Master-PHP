<?php

namespace Master\Helpers;


/**
 * Flash
 */
class Flash 
{
    
    /**
     * Method setFlash
     *
     * @param $index $index [explicite description]
     * @param $message $message [explicite description]
     *
     * @return void
     */
    public static function setFlash($index,$message)
    {
        if( ! isset($_SESSION[$index]) )
        {
            $_SESSION[$index] = $message;
        }

    } 

    
    /**
     * Method getFlash
     *
     * @param $index $index [explicite description]
     *
     * @return void
     */
    public static function getFlash($index)
    {
        if( isset($_SESSION[$index]) )
        {
            $message = $_SESSION[$index];

        }


        unset($_SESSION[$index]);

        return $message ?? '';        
    }
}