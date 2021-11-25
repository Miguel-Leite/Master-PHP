<?php


namespace Master\Core\Api;

use Master\Traits\Response;

abstract class RestAPI implements InterfaceAPI
{

    use Response;
    

    public function read()
    {
        
    }

    public function create(array $data)
    {
        
    }

    public function edit(int $id)
    {
        
    }


    public function update(int $id, array $data)
    {
        
    }


    public function delete(int $id)
    {
        
    }

}