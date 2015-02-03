<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
class Categories extends \Phalcon\Mvc\Model
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
    public $created;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id', 
            'name' => 'name', 
            'created' => 'created', 
            'status' => 'status'
        ];
    }

}
