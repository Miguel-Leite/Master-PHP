<?php

namespace Master\Security;


/**
 * Csrf
 */
class Csrf
{
    
    /**
     * csrf
     *
     * @var mixed
     */
    private $csrf;

    
    /**
     * Method getToken
     *
     * @return void
     */
    public static function getToken()
    {
        if( !isset( $_SESSION["token"] ) )
        {
            return $_SESSION["token"] = random_int(1000,99999) . "-" . md5( uniqid()) . "-" . time();
        } else {

            unset( $_SESSION["token"] );

            return $_SESSION["token"] = random_int(1000,99999) . "-" . md5( uniqid()) . "-" . time();
        }
    }

    
    /**
     * Method verifyToken
     *
     * @param $csrf $csrf [explicite description]
     *
     * @return void
     */
    public function verifyToken( $csrf )
    {

        if ( !isset( $csrf ))
        {
            return false;
        } else {

            if ( $csrf != $_SESSION["token"])
            {
                return false;
            }

            return true;

        }

    }
}