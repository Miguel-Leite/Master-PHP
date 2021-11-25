<?php

namespace Master\Database;

/**
 * QueryBuilder
 */
class QueryBuilder extends QueryCreate implements QueryBuilderInterface
{
    
     
    
    /**
     * Method insert
     *
     * @param array $data [explicite description]
     * @param string $table [explicite description]
     *
     * @return string
     */
    public static function insert(array $data, string $table):string
    {
        $sql = 'INSERT `'.$table.'` (' . self::fields($data) . ') VALUES (' . self::insertedPlaceHolders($data) . ')';
        return $sql;
    }


    
    /**
     * Method update
     *
     * @param array $data [explicite description]
     * @param string $table [explicite description]
     * @param array $where [explicite description]
     *
     * @return string
     */
    public static function update(array $data, string $table, array $where):string
    {
        $sql = 'UPDATE `' . $table . ' SET ' . self::updatePlaceholders($data) . ' WHERE ' . self::where($where);
        return $sql;
    }

    
    
    /**
     * Method insertedPlaceHolders
     *
     * @param array $data [explicite description]
     *
     * @return string
     */
    public static function insertedPlaceHolders(array $data = []):string
    {
        $placeholders = array_keys($data);
        $sql = '';
        for ($i = 0; $i < count($placeholders);$i++)
        {
            if ($i > 0) {
                $sql .= ",";
            }

            $sql .= ":" . $placeholders[$i];
        }

        return $sql;
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
        $placeholders = array_keys($data);

        $sql = "";

        for ($i = 0;$i < count($placeholders);$i++)
        {
            if ($i > 0) {
                $sql .= ",";
            }

            $sql .= "`" . $placeholders[$i] . "`";
        }

        return $sql;
    }


    
    /**
     * Method updatePlaceholders
     *
     * @param array $data [explicite description]
     *
     * @return string
     */
    public static function updatePlaceholders(array $data = []):string
    {
        $sql = '';
        $counter = 0;
        $total = count($data);

        foreach ($data as $field => $value)
        {
            $counter++;
            $sql .= '`' . $field . '` =:' . $field;
            if ($counter < $total)
            {
                $sql .= ', ';
            } else {
                $sql .= ' ';
            }
        }


        return $sql;

    }
    
    /**
     * Method insertOrUpdate
     *
     * @param array $data [explicite description]
     * @param string $table [explicite description]
     * @param array $where [explicite description]
     *
     * @return string
     */
    public static function insertOrUpdate(array $data, string $table, array $where):string
    {

        if (empty($where))
        {
            $sql = self::insert($data,$table);
        } else {
            $sql = self::update($data,$table,$where);
        }

        return $sql;

    }

    
    /**
     * Method findOneBy
     *
     * @param string $table [explicite description]
     *
     * @return string
     */
    public static function findOneBy(string $table):string
    {
        return "SELECT * FROM `" . $table . "` WHERE id=:id";
    }

        
    /**
     * Method findAll
     *
     * @param string $table [explicite description]
     *
     * @return string
     */
    public static function findAll(string $table):string
    {
        return "SELECT * FROM `" . $table . "`";
    }

    
    /**
     * Method where
     *
     * @param array $conditions [explicite description]
     *
     * @return string
     */
    public static function where(array $conditions = []):string
    {
        $sql = '';

        $total = count($conditions);
        $num = 0;
        foreach ($conditions as $field => $value)
        {
            $num++;
            $sql .= '`' . $field . '` =:'. $field; 
            if ($num < $total)
            {
                $sql .= ' AND ';
            }
        }

        return $sql;
    }

    
    /**
     * Method findAllBy
     *
     * @param string $table [explicite description]
     * @param array $where [explicite description]
     *
     * @return string
     */
    public static function findAllBy(string $table, array $where):string
    {

        $sql = "SELECT * FROM `" . $table . "` WHERE " . self::where($where);

        return $sql;

    }

}