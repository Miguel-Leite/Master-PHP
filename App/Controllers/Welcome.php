<?php

namespace App\Controllers;

use App\Models\User;

/**
 * Welcome
 */
class Welcome extends BaseController{

    public $user;
    
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User();
    }
    
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        view("welcome",["title" => "Welcome to Framework Master PHP v.1.0"]);
    }

    public function about(){
        
        echo "Page about";
    }

    

}