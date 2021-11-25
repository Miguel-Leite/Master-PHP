<?php

namespace Master\Core\Api;

interface InterfaceAPI
{
    
    /**
     * Method read
     *
     * @return void
     */
    public function read();
    
    /**
     * Method create
     *
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function create(array $data);
    
    /**
     * Method edit
     *
     * @param int $id [explicite description]
     *
     * @return void
     */
    public function edit(int $id);
    
    /**
     * Method update
     *
     * @param int $id [explicite description]
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function update(int $id, array $data);
    
    /**
     * Method delete
     *
     * @param int $id [explicite description]
     *
     * @return void
     */
    public function delete(int $id);
}