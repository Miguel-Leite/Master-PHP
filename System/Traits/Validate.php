<?php

namespace Master\Traits;

use Master\Helpers\Flash;

trait Validate
{

    private static $error = false;
        
    /**
     * Method required
     *
     * @param ...$fields $fields [explicite description]
     *
     * @return object
     */
    public static function required(...$fields)
    {


        foreach ($fields as $field)
        {

            if(empty($_POST[$field]))
            {

                Flash::setFlash($field,"Esse campo é obrigatorio");
                static::$error = true;

            }

        }

        return new static;


    }
    
    /**
     * Method email
     *
     * ...$fields $fields [explicite description]
     *
     * @return object
     */
    public static function email(...$fields)
    {

        foreach ($fields as $field)
        {

            if(!filter_input(INPUT_POST,$field,FILTER_VALIDATE_EMAIL))
            {

                Flash::setFlash($field,"O email informado não é válido.");
                static::$error = true;

            }

        }


        return new static;


    }

    public function is_bi (...$fields)
    {
        foreach ($fields as $field){
            $data = filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);
        
            if (!preg_match("/^[0-9]{9}+[aA-zZ]{2}+[0-9]{3}$/",$data)){
                Flash::setFlash($field,"O numero de identidade é inválido!");
                static::$error = true;
            }
        }

        return new static;
    }
        
    
    /**
     * Method unique
     *
     * @param $field $field [explicite description]
     * @param $model $model [explicite description]
     *
     * @return object
     */
    public static function unique($field,$model)
    {
        
        $modelToValidate = new $model();


        $register = $modelToValidate->find($field,$_POST[$field]);


        if ($register)
        {
            Flash::setFlash($field,"O email informado já está cadastrado no nosso sistema.");
            static::$error = true;
        }

        return new static;

    }

    
    /**
     * Method failed
     *
     * @return bool
     */
    public static function failed():bool
    {

        return static::$error;

    }
    
    /**
     * Method notValidation
     *
     * @return void
     */
    public static function notValidation()
    {
        return new static;
    }

}