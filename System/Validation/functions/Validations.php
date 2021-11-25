<?php

use Master\Database\Database;
use Master\Helpers\Flash;

/**
 * Method validate
 *
 * @param array $validations [explicite description]
 *
 * @return void
 */
function validate(array $validations)
{
    $result = [];
    $param = null;
    foreach ($validations as $field => $validate) {
        $result[$field] = (!str_contains($validate,'|')) ?
                        singleValidation($validate,$field,$param) :
                        multipleValidations($validate,$field,$param);
    }
    
    if(in_array(false,$result)){
        return false;
    }

    return $result;
}

/**
 * Method singleValidation
 *
 * $validate $validate [explicite description]
 * $field $field [explicite description]
 * $param $param [explicite description]
 *
 * @return void
 */
function singleValidation($validate,$field,$param){
    if(str_contains($validate,':')){
        list($validate,$param) = explode(':',$validate);
    }
    
    return $result[$field] = $validate($field,$param);
}

/**
 * Method multipleValidations
 *
 * $validate $validate [explicite description]
 * $field $field [explicite description]
 * @param $param $param [explicite description]
 *
 * @return void
 */
function multipleValidations($validate,$field,$param){

    $explodePipeValidate = explode('|',$validate);

    foreach ($explodePipeValidate as $validate) {
        if(str_contains($validate,':')){
            list($validate,$param) = explode(':',$validate);
        }
        $result = $validate($field,$param);
    }
    return $result;
}

/**
 * Method required
 *
 * $field $field [explicite description]
 *
 * @return void
 */
function required($field)
{
    if($_POST[$field] == ''){
        Flash::setFlash("message","O campo {$field} é obrigatório!");
        return false;
    }

    return filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);
}

/**
 * Method email
 *
 * $field $field [explicite description]
 *
 * @return void
 */
function email($field)
{
    $emailIsValid = filter_input(INPUT_POST,$field,FILTER_VALIDATE_EMAIL);

    if(!$emailIsValid){
        Flash::setFlash($field,"O email {$emailIsValid} não é válido!");
        return false;   
    }

    return filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);

}

/**
 * Method unique
 *
 * $field $field [explicite description]
 * $param $param [explicite description]
 *
 * @return void
 */
function unique($field,$param){
    $db = new Database();
    $data = filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);
    
    $sql = "SELECT {$field} FROM {$param} WHERE {$field} = :{$field}";
    $db->query($sql);
    $db->bind(":{$field}",$data);
    $email = $db->result();

    if($email){
        Flash::setFlash($field,"Este email já esta cadastrado!");
        return false;
    }
}

/**
 * Method maxlen
 *
 * $field $field [explicite description]
 * $param $param [explicite description]
 *
 * @return void
 */
function maxlen($field,$param){

    $data = filter_input(INPUT_POST,$field,FILTER_SANITIZE_STRING);
    // var_dump($field);
    if(strlen($field) > $param)
    {
        Flash::setFlash($field,"Este campo não pode passar de {$param} caracteres!");
        return false;
    }

    return $data;
}

function is_bi ($bi)
{
    $data = filter_input(INPUT_POST,$bi,FILTER_SANITIZE_STRING);
    if (!preg_match("/^[0-9]{9}+[aA-zZ]{2}+[0-9]{3}$/",$data)){
        Flash::setFlash($bi,"O numero de identidade é inválido!");
        return false;
    }

    return $data;
}