<?php

namespace Master\Helpers;

/**
 * Redirect
 */
class Redirect 
{
    
    /**
     * Method to
     *
     * @param $to $to [explicite description]
     *
     * @return void
     */
    public static function to($to = null)
    {
        $redirect = ($to != null) ? $to : "";

        return header('Location:' . base_url() .$redirect);
    }
    
    /**
     * Method back
     *
     * @return void
     */
    public static function back()
    {
        $previous = "javascript::history.go(-1)";

        if( isset($_SERVER["HTTP_REFERER"]) )
        {
            $previous = $_SERVER["HTTP_REFERER"];
        }

        return header("Location:{$previous}");

        die;
    }

}