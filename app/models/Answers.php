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
     * @var string
     */
    public $name;

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
        return [
            'id' => 'id',
            'name' => 'name', 
            'word_id' => 'word_id', 
            'correct' => 'correct'
        ];
    }

    public static function fetchAll()
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->columns(['id' => 't1.id', 'name' => 't1.name', 'correct' => 't1.correct', 'word_id' => 't2.id', 'word_name' => 't2.name'])
            ->from(['t1' => 'Answers'])
            ->join('Words', 't1.word_id=t2.id', 't2')
            ->getQuery()
            ->execute();
    }

    public function fetchByWordId($id)
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->from('Answers')
            ->where('word_id=:word_id:', ['word_id' => $id])
            ->getQuery()
            ->execute();
    }
}
