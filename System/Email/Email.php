<?php

namespace Master\Email;


class Email extends \PHPMailer\PHPMailer\PHPMailer {

    
    /**
     * email
     *
     * @var mixed
     */
    private $email;    
    /**
     * body
     *
     * @var mixed
     */
    private $body;    
    /**
     * to
     *
     * @var mixed
     */
    private $to;    
    /**
     * for
     *
     * @var mixed
     */
    private $for;    
    /**
     * copy
     *
     * @var mixed
     */
    private $copy;    
    /**
     * subject
     *
     * @var mixed
     */
    private $subject;    
    /**
     * message
     *
     * @var mixed
     */
    private $message;
    
    /**
     * Method setEmail
     *
     * @param $email $email [explicite description]
     *
     * @return void
     */
    public function setEmail( $email ){
        $this->email = $email;
    }
    
    /**
     * Method setBody
     *
     * @param $body $body [explicite description]
     *
     * @return void
     */
    public function setBody( $body ){
        $this->body = $body;
    }
    
    /**
     * Method setTo
     *
     * @param $to $to [explicite description]
     *
     * @return void
     */
    public function setTo( $to ){
        $this->to = $to;
    }
        
    /**
     * Method setFor
     *
     * @param $for $for [explicite description]
     *
     * @return void
     */
    public function setFor( $for ){
        $this->for = $for;
    }
        
    /**
     * Method setCopy
     *
     * @param $copy $copy [explicite description]
     *
     * @return void
     */
    public function setCopy( $copy ){
        $this->copy = $copy;
    }
        
    /**
     * Method setSubject
     *
     * @param $subject $subject [explicite description]
     *
     * @return void
     */
    public function setSubject( $subject ){
        $this->subject = $subject;
    }
    
    /**
     * Method setMessage
     *
     * @param $message $message [explicite description]
     *
     * @return void
     */
    public function setMessage( $message ){
        $this->message = $message;
    }
        
    /**
     * Method sendEmail
     *
     * @return bool
     */
    public function sendEmail():bool
    {
        $this->charSet = "UTF-8";
        $this->SMTPSecure = "ssl";
        $this->isSMTP();
        $this->Host = "";
        $this->Port;
        $this->SMTPAuth = true;
        $this->Username = "";
        $this->Password = "";
        $this->setFrom("");
        $this->FromName = $this->to;
        $this->addAddress($this->for);
        $copy = $this->copy;

        if ( !empty ($copy) ){
            $this->addAddress( $copy );
        }

        $this->Subject = $this->subject;
        $this->AltBody = "Para você ver esse email, tenha certeza de estar vendo em um programa que aceita ver html.";
        $this->msgHTML($this->body);

        return $this->send();
    }   
}