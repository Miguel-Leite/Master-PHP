<?php

namespace Master\Database;

use PDO;


/**
 * Database
 */
class Database 
{
    
    /**
     * stmt
     *
     * @var mixed
     */
    protected $stmt;
    
    /**
     * dbh
     *
     * @var mixed
     */
    protected $dbh;
    
    /**
     * Method __construct
     *
     * @param $database=null $database [explicite description]
     *
     * @return void
     */
    public function __construct($database=null)
    {

        try {

            $database = ($database) ? $database : "db";
            
            $config = (object) $this->getDatabase($database);
            
            $dsn = $config->driver.":host=".$config->host.";port=".$config->port.";dbname=".$config->dbname;

            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];

            
            $this->dbh = new PDO($dsn,$config->user,$config->password,$options);

        } catch (\Exception $e) {
            throw new \Exception("Error database: ".$e->getMessage());
        }

    }
    
    /**
     * Method getDatabase
     *
     * @param $index $index [explicite description]
     *
     * @return void
     */
    private function getDatabase($index)
    {
        return setDatabase()[$index];
    }

    
    /**
     * Method query
     *
     * @param $sql $sql [explicite description]
     *
     * @return void
     */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
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
     * Method fieldsModel
     *
     * @param array $data [explicite description]
     *
     * @return string
     */
    public static function fieldsModel(array $data = []):string
    {
        $placeholders = array_keys($data);

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
     * Method insertedPlaceHolders
     *
     * @param array $data [explicite description]
     *
     * @return string
     */
    public function insertedPlaceHolders(array $data = []):string
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
     * Method updatePlaceholders
     *
     * @param array $data [explicite description]
     *
     * @return string
     */
    public function updatePlaceholders(array $data = []):string
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
     * Method bind
     *
     * @param $parameters $parameters [explicite description]
     * @param $value $value [explicite description]
     * @param $type $type [explicite description]
     *
     * @return void
     */
    public function bind($parameters, $value, $type = null)
    {

        if(is_null($type))
        {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($parameters,$value,$type);

    }
    
    /**
     * Method execute
     *
     * @param $data $data [explicite description]
     *
     * @return void
     */
    public function execute($data = null)
    {
        return $this->stmt->execute($data);
    }
    
    /**
     * Method result
     *
     * @return void
     */
    public function result()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Method results
     *
     * @return void
     */
    public function results()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Method rowCount
     *
     * @return void
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    
    /**
     * Method lastId
     *
     * @return void
     */
    public function lastId()
    {
        return $this->stmt->lastInsertId();
    }

    
}