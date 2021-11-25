<?php

namespace Master\Database\Builder;

/**
 * WhereCollection
 */
class WhereCollection implements \Master\Database\Builder\CollectionInterface
{
    
    /**
     * whereClause
     *
     * @var array
     */
    private $whereClause = [];

    
    /**
     * Method add
     *
     * @param string $name [explicite description]
     *
     * @return WhereCollection
     */
    public function add(string $field, $value): WhereCollection
    {
        $this->whereClause[$field] = $value;
        return $this;
    }
    
    /**
     * Method setWhere
     *
     * @param array $fields [explicite description]
     *
     * @return WhereCollection
     */
    public function set(array $where = []): CollectionInterface
    {
        $this->whereClause = $where;

        return $this;
    }

    
    /**
     * Method getSQL
     *
     * @return string
     */
    public function getSQL():string
    {
        $sql = '';
        $counter = 0;
        $count = count($this->whereClause);

        foreach ($this->whereClause as $field => $value) {
            $counter++;
            $sql .= '`' . $field . '` =:' . $field;

            if ($counter < $count)
            {
                $sql .= ' AND ';
            }
        }
        
        return $sql;

    }

}