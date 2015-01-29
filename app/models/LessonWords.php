<?php

class LessonWords extends \Phalcon\Mvc\Model
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
    public $lesson_id;

    /**
     *
     * @var integer
     */
    public $word_id;

    /**
     *
     * @var integer
     */
    public $answer_id;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'lesson_id' => 'lesson_id', 
            'word_id' => 'word_id', 
            'answer_id' => 'answer_id'
        );
    }

}
