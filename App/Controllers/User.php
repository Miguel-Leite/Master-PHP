<?php

namespace App\Controllers;

use Master\Core\Api\RestAPI;

class User extends RestAPI
{

    public function user()
    {
        $data = [
            "name" => "Miguel",
            "email" => "miguelleite200leite@gmail.com"
        ];
        return $this->response($data);   
    }

}