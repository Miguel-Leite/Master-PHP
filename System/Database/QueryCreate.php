<?php

namespace Master\Database;
use Master\Database\QueryBuilderInterface;
use Master\Database\Builder\FieldCollection;
use Master\Database\Builder\WhereCollection;

class QueryCreate implements QueryBuilderInterface
{
            
    /**
     * sql
     *
     * @var string
     */
    private $sql = '';
    
    /**
     * fieldCollection
     *
     * @var mixed
     */
    private $fieldCollection;

    private $whereCollection;


    public function __construct(FieldCollection $fieldCollection, WhereCollection $whereCollection)
    {
        $this->fieldCollection = $fieldCollection;

        $this->whereCollection = $whereCollection;
    }


    /**
     * Method select
     *
     * @param string $tableName [explicite description]
     *
     * @return void
     */
    public function select(string $tableName, array $fields = []):QueryBuilderInterface
    {
        $fieldCollection = $this->fieldCollection->setFields($fields);

        $this->sql .= "SELECT ". $fieldCollection->getSQL() ." FROM `" . $tableName . "`";
        return $this;
    }


    /**
     * Method fields
     *
     * @param array $data [explicite description]
     *
     * @return string
     */
    public static function fields(array $data = []):string
    {

        $sql = "";

        for ($i = 0;$i < count($data);$i++)
        {
            if ($i > 0) {
                $sql .= ",";
            }

            $sql .= "`" . $data[$i] . "`";
        }

        return $sql;
    }


    
    /**
     * Method andWhere
     *
     * @param string $filedName [explicite description]
     * @param $value $value [explicite description]
     *
     * @return QueryBuilderInterface
     */
    public function andWhere(string $filedName, $value): QueryBuilderInterface
    {
        return $this;
    }

    
    /**
     * Method getSQL
     *
     * @return string
     */
    public function getSQL():string
    {
        return trim($this->sql);
    }

}