<?php

class Answers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $word_id;

    /**
     *
     * @var integer
     */
    public $correct;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'word_id' => 'word_id', 
            'correct' => 'correct'
        );
    }

}
