<?php

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Message;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $re_password;
    /**
     *
     * @var string
     */
    public $avatar;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if (strcasecmp($this->password, $this->re_password) !== 0) {
            $this->_errorMessages[] = new Message("Re-password must be the same Password", "password", "Hash");
            return false;
        }
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'name' => 'name', 
            'email' => 'email', 
            'password' => 'password', 
            're_password' => 're_password',
            'avatar' => 'avatar', 
            'created' => 'created', 
            'status' => 'status'
        );
    }

}
