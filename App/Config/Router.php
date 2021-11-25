<?php



/**
 * Method setRouters
 * 
 * SETTING ROUTER
 *
 * @return array
 */
function setRouters():array
{

    return [


        /* DEFINE HERE YOUR ROUTER
        |
        |
        |
        |
        |
        |
        | url: home
        | "home"=>"Home::index"
        | http://domain.com/home
        |
        |
        | 
        |
    
         */


    
        "ROUTERS" => [
            "/" => "Welcome::index",
            "user" => "User::user",
            "about" => "Welcome::about"
        ]
    
            
    
    ];

}


