<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

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
        return [
            'id' => 'id', 
            'lesson_id' => 'lesson_id', 
            'word_id' => 'word_id', 
            'answer_id' => 'answer_id'
        ];
    }

    public static function fetchByLessonId($word_id)
    {
        $sql = "SELECT t1.*, t3.name as word_mean, t3.correct as correct
                FROM lesson_words t1, words t2, answers t3
                WHERE t1.word_id=t2.id AND t1.answer_id=t3.id AND t1.word_id='{$word_id}'";
        $lesson_word = new Resultset(null, $follows = new Follows(), $follows->getReadConnection()->query($sql));
        return $lesson_word->getFirst();
    }

}
