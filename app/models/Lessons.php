<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Lessons extends \Phalcon\Mvc\Model
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
    public $user_id;

    /**
     *
     * @var integer
     */
    public $category_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id', 
            'user_id' => 'user_id', 
            'category_id' => 'category_id', 
            'created' => 'created'
        ];
    }

    public static function fetchByUserId($str)
    {
        $user_id = Phalcon\DI::getDefault()->getSession()->get('user_id');
        $sql = "SELECT t1.*, t2.name as category_name, t3.name as user_name, t3.avatar as avatar 
                FROM lessons t1, categories t2, users t3 
                WHERE t1.user_id=t3.id AND t1.category_id=t2.id AND user_id='{$user_id}'" . $str;
        return new Resultset(null, $follows = new Follows(), $follows->getReadConnection()->query($sql));
    }

    public static function dateConvert($date)
    {
        return date('Y/m/d', strtotime($date));
    }

    public static function fetchByCategoryWords($lesson_id)
    {
        $sql = "SELECT t1.*, t2.name as category_name, t3.name as word_name, t3.id as word_id
                FROM lessons t1, categories t2, words t3 
                WHERE t1.category_id=t2.id AND t2.id=t3.category_id AND t1.id={$lesson_id}";
        return new Resultset(null, $lesson = new Lessons(), $lesson->getReadConnection()->query($sql));
    }
}
