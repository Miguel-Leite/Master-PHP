<?php

namespace App\Models;

use Master\Database\Database;
use Master\Database\Models\Model;

class User extends Model {

    protected $table = "user";

    protected $primary_key = "id";

    protected $fields = ["name","email","password"];

    

    public function select()
    {
        
        
    }

}