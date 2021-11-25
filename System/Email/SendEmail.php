<?php


namespace Master\Email;


class SendEmail
{
    
    /**
     * email
     *
     * @var mixed
     */
    private $email;

        
    /**
     * data
     *
     * @var mixed
     */
    private $data;
        
    /**
     * Method __construct
     *
     * @param Email $email [explicite description]
     *
     * @return void
     */
    public function __construct(Email $email)
    {

        $this->email = $email;

    }

    
    /**
     * Method data
     *
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function data (array $data)
    {

        $this->data = $data;

    }

    
    /**
     * Method send
     *
     * @return void
     */
    public function send()
    {

        $this->email->setSubject($this->data['subject']);
        $this->email->setTo($this->data['to']);
        $this->email->setFrom($this->data['from']);
        $this->email->setBody($this->data['body']);
        
        return $this->email->sendEmail();

    }

}