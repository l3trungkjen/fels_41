<?php

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

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
                [
                    'field'    => 'email',
                    'required' => true,
                ]
            )
        );
        if (!empty($this->re_password)) {
            if (strcmp($this->password, $this->re_password) !== 0) {
                $this->_errorMessages[] = new Message('Re-password must be the same Password', 'password', 'Hash');
                return false;
            }
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
        return [
            'id' => 'id', 
            'name' => 'name', 
            'email' => 'email', 
            'password' => 'password', 
            're_password' => 're_password',
            'avatar' => 'avatar', 
            'created' => 'created', 
            'status' => 'status'
        ];
    }

    public static function uploadImage()
    {
        if (isset($_FILES['file']['type'])) {
            $file_type = ['image/png', 'image/jpg', 'image/jpeg'];
            $validextensions = ['jpeg', 'jpg', 'png'];
            $temporary = explode('.', $_FILES['file']['name']);
            $file_extension = end($temporary);
            if (in_array($_FILES['file']['type'], $file_type) && in_array($file_extension, $validextensions)) {
                if (($_FILES['file']['error'] > 0) && ($_FILES['file']['size'] < 100000)) {
                    return false;
                } else {
                    if (file_exists('img/upload/' . $_FILES['file']['name'])) {
                        return false;
                    } else {
                        $sourcePath = $_FILES['file']['tmp_name'];
                        $targetPath = 'img/upload/' . time() . $_FILES['file']['name'];
                        move_uploaded_file($sourcePath, $targetPath);
                    }
                    return $targetPath;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function fetchDifferentUserId($user_id)
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->from('Users')
            ->where('id<>:id:', ['id' => $user_id])
            ->getQuery()
            ->execute();
    }

    public static function checkPermission($id)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM users WHERE id=$id";
            $user = new Resultset(null, $users = new Users(), $users->getReadConnection()->query($sql));
            if ($_user = $user->getFirst()) {
                return $_user->status == 0 ? true : false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
