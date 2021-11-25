<?php

namespace Master\Database;

/**
 * QueryBuilderInterface
 */
interface QueryBuilderInterface{
    
    /**
     * Method select
     *
     * @param string $tableName [explicite description]
     * @param array $fields [explicite description]
     *
     * @return QueryBuilderInterface
     */
    public function select(string $tableName, array $fields = []): QueryBuilderInterface;
    
    /**
     * Method andWhere
     *
     * @param string $filedName [explicite description]
     * @param $value $value [explicite description]
     *
     * @return QueryBuilderInterface
     */
    public function andWhere(string $filedName, $value): QueryBuilderInterface;
    
    /**
     * Method getSQL
     *
     * @return string
     */
    public function getSQL();

}