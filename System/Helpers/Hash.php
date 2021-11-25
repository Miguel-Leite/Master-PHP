<?php


/**
 * Method pass_hash
 *
 * @param $password $password [explicite description]
 * @param $type $type [explicite description]
 *
 * @return string
 */
function pass_hash (string $password,$type = null):string
{
    
    return password_hash($password,($type) ? $type : 1 );

}


/**
 * Method hash_verify
 *
 * @param $password $password [explicite description]
 * @param $hash $hash [explicite description]
 *
 * @return string
 */
function hash_verify(string $password,string $hash):string
{
    return password_verify($password,$hash);
}