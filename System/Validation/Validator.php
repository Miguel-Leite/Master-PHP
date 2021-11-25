<?php


namespace Master\Validation;

use Master\Traits\Sanitize;
use Master\Traits\Validate;
use Master\Traits\Validations;

/**
 * Validator
 */
class Validator
{

    use Validate, Sanitize;
    
    /**
     * Method validate
     *
     * @param \Closure $callback [explicite description]
     * @param $returnType $returnType [explicite description]
     *
     * @return object
     */
    public static function validate(\Closure $callback, $returnType = null):object|array
    {

        if (is_callable($callback))
        {
            $callback();

            return self::dataSanitized($returnType);
        }

    } 
}