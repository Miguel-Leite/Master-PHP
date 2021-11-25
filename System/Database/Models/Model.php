<?php

namespace Master\Database\Models;

use Master\Database\Database;
use Master\Database\QueryBuilder;

abstract class Model extends Database{

    public function findById($id)
    {
        $this->query("SELECT * FROM `" . $this->table . "` WHERE id={$id}");
        return $this->result();
    }

    public function findBy($table,$field)
    {
        $sql = "SELECT {$field} FROM {$table}"; 
        $this->query($sql);
        return $this->results();
    }

    public function find($field,$value = null)
    {
        if (!is_null($value)){
            $sql = "SELECT * FROM {$this->table} WHERE {$field} = :{$field}"; 
            $this->query($sql);
            $this->bind($field,$value);
            return $this->result();
        }

        $sql = "SELECT {$field} FROM {$this->table}"; 
        $this->query($sql);
        return $this->results();
        
    }


    public function findAll ()
    {

        $sql = "SELECT * FROM {$this->table}";
        $this->query($sql);
        return $this->results();

    }

    public function create(array $data)
    {
        $fields = '';

        if (empty($this->fields) || !isset($this->fields)){
            $fields = array_keys($data);
        } else {
            $fields = $this->fields;
        }
        

        $sql = "INSERT INTO {$this->table} ({$this->fieldsModel($fields)}) VALUES ({$this->insertedPlaceHolders($data)})";
        $this->query($sql);
        foreach ($data as $key => $value) {
            # code...
            $this->bind(":".$key, $value);

        }   

        return $this->execute();

        
    }

    public function update($data)
    {   

        if (empty($this->primary_key) || !isset($this->primary_key)){
            return "Não definido o primary_key na classe model";
        }

        if (array_key_exists($this->primary_key,$data)){
            $id = $data[$this->primary_key];
        } else {
            return "Não foi passado um ID";
        }
        

        $sql = 'UPDATE ' . $this->table .' SET '. $this->updatePlaceholders($data) . ' WHERE id =:' .$this->primary_key;
        $this->query($sql);

        foreach ($data as $key => $value) {
            # code...

            $this->bind(":id", $id);
            $this->bind(":".$key, $value);

        }   

        return $this->execute();
        
    }


    public function delete($id)
    {
        
        $verify = $this->find($this->primary_key,$id);
        if (empty($verify))
        {
            return false;
        }
        
        $sql = "DELETE FROM {$this->table} WHERE {$this->primary_key} = :{$this->primary_key}";
        $this->query($sql);
        $this->bind(":".$this->primary_key,$id);
        return $this->execute();
    }


}