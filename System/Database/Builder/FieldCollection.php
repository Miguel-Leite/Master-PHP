<?php

namespace Master\Database\Builder;
use  Master\Database\Builder\CollectionInterface;

class FieldCollection implements CollectionInterface
{

    private $fields = [];

    
    /**
     * Method add
     *
     * @param string $name [explicite description]
     *
     * @return FieldCollection
     */
    public function add(string $name): FieldCollection
    {
        $this->fields[] = $name;
        return $this;
    }
    
    /**
     * Method setFields
     *
     * @param array $fields [explicite description]
     *
     * @return FieldCollection
     */
    public function set(array $fields = []): CollectionInterface
    {
        $this->fields = [];
        for ($i = 0;$i < count($fields);$i++)
        {
            $this->add($fields[$i]);
        }

        return $this;
    }

    
    /**
     * Method getSQL
     *
     * @return string
     */
    public function getSQL():string
    {
        $sql = '*';

        if (!empty($this->fields))
        {    
            $sql = '';
            for ($i = 0;$i < count($this->fields);$i++)
            {
                if ($i > 0) {
                    $sql .= ",";
                }

                $sql .= "`" . $this->fields[$i] . "`";
            }
        }
        
        return $sql;

    }

}