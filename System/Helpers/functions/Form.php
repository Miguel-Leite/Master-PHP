<?php

use Master\Security\Csrf;

/**
 * Method form_open
 *
 * @param $action=null $action [explicite description]
 * @param $method=null $method [explicite description]
 * @param $id=null $id [explicite description]
 * @param $class=null $class [explicite description]
 * @param $enctype=null $enctype [explicite description]
 *
 * @return void
 */
function form_open($action=null,$method=null, $id=null, $class=null, $enctype=null)
{
    return '<form ection="' . $action .'" method="'. $method .'" id="'. $id .'" class="'. $class .'" enctype="'. $enctype .'">' . form_csrf();
}

/**
 * Method form_csrf
 *
 * @return void
 */
function form_csrf()
{
    return '<input type="text" name="'. App()["CSRF_NAME"] .'" value="'. Csrf::getToken() .'" hidden>';
}

/**
 * Method input
 *
 * @param $type $type [explicite description]
 * @param $name $name [explicite description]
 * @param $id=null $id [explicite description]
 * @param $class=null $class [explicite description]
 * @param $placeholder=null $placeholder [explicite description]
 *
 * @return void
 */
function input($type,$name,$id=null, $class=null, $placeholder=null)
{
    return '<input type="' . $type .'" name="'. $name .'" id="'. $id .'" class="'. $class .'" placeholder="'. $placeholder .'">';
}

/**
 * Method button_submit
 *
 * @param $name $name [explicite description]
 * @param $id=null $id [explicite description]
 * @param $class=null $class [explicite description]
 *
 * @return void
 */
function button_submit($name,$id=null, $class=null)
{
    return '<input type="submit" name="'. $name .'" id="'. $id .'" class="'. $class .'" >';
}
/**
 * Method form_close
 *
 * @return void
 */
function form_close()
{
    return '</form>';
}