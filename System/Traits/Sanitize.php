<?php


namespace Master\Traits;

use Master\Core\Controller;
use App\Language\PT\Language;

trait Sanitize
{
    

    private static $sanitized = [];
    
    /**
     * Method sanitize
     *
     *  ...$indexs $indexs [explicite description]
     *
     * @return object
     */
    public function sanitize(...$indexs):object
    {

        foreach ($indexs as $index) {
            
            if (!strpos($index,':'))
            {
                throw new \Exception(Controller::ExceptionView("ExceptionView",[
                    "title" => "Erro na validação!", 
                    "message" => "Ops! Erro na sua validação no indice <b>{$index}</b>, verifique se tem os dois pontos."])
                );

            }

            [$fieldToValidate,$typeValidate] = explode(':',$index);

            switch ($typeValidate) {

                case 's':
                    
                    static::$sanitized[$fieldToValidate] = $this->string($_POST[$fieldToValidate]);

                    break;

                case 'i':
                    
                    static::$sanitized[$fieldToValidate] = $this->int($_POST[$fieldToValidate]);

                    break;
            }

        }

        return new static;

    }
    
    /**
     * Method string
     *
     * @param $string $string [explicite description]
     *
     * @return string
     */
    public function string($string):string
    {
        try {
            return filter_var($string,FILTER_SANITIZE_STRING);
        } catch (\Exception $e) {
            throw new \Exception(Controller::ExceptionView("ExceptionView",[
                "title" => "Error", 
                "message" => $e->getMessage()])
            );
        }

    }

    
    /**
     * Method int
     *
     * @param $int $int [explicite description]
     *
     * @return int
     */
    public function int($int):int
    {  
        try {

            return filter_var($int,FILTER_SANITIZE_NUMBER_INT);

        } catch (\Exception $e) {

            throw new \Exception(Controller::ExceptionView("ExceptionView",[
                "title" => "Error", 
                "message" => $e->getMessage()])
            );
            
        }

    }

    
    /**
     * Method dataSanitized
     *
     * $returnType $returnType [explicite description]
     *
     * @return object
     */
    public static function dataSanitized($returnType):object|array
    {

        if (empty(static::$sanitized))
        {
            throw new \Exception(Controller::ExceptionView("ExceptionView",[
                "title" => "ERROR!", 
                "message" => "Ops! Os seus dados não estão protegido, por favor proteja os seus dados, usando sempre o sanitize."])
            );
            
        }

        if (!is_null($returnType))
        {
            if (strtolower($returnType) == "array")
            {
                return (array) static::$sanitized;
                die;
            }   


            if( strtolower($returnType) == "object" ) 
            {
                return (object) static::$sanitized;
                die;
            }

            throw new \Exception(Controller::ExceptionView("ExceptionView",[
                "title" => "ERROR!", 
                "message" => "O framework Master não conhece o tipo de retorno <b>{$returnType}</b> como um retorno de dados ."])
            );
        }

        return (object) static::$sanitized;
    }
    
    /**
     * Method getField
     *
     * @param $field $field [explicite description]
     *
     * @return void
     */
    public static function getField($field)
    {
        return static::$sanitized[$field];
    }

}
