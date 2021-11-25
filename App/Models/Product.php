<?php

namespace App\Models;

use Master\Database\Database;
use Master\Database\Models\Model;

class Product extends Model {

    protected $table = "Product";

    protected $primary_key = "id";

    protected $fields = ["name","email","password"];

    

    public function select()
    {
        
        
    }

}