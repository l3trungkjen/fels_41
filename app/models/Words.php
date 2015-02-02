<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
class Words extends \Phalcon\Mvc\Model
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
    public $category_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $mean;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return [
            'id' => 'id', 
            'category_id' => 'category_id', 
            'name' => 'name', 
            'mean' => 'mean'
        ];
    }

    public static function fetchAll()
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->columns(['id' => 't1.id', 'name' => 't1.name', 'mean' => 't1.mean', 'category_id' => 't2.id', 'cate_name' => 't2.name'])
            ->from(['t1' => 'Words'])
            ->join('Categories', 't1.category_id=t2.id', 't2')
            ->getQuery()
            ->execute();
    }

    public static function fetchCountByCategoryId($category_id)
    {
        $sql = "SELECT COUNT(category_id) as total FROM words WHERE category_id={$category_id}";
        $result = new Resultset(null, $words = new Words(), $words->getReadConnection()->query($sql));
        foreach ($result as $key => $value) {
            $total = $value->total;
        }
        return $total == null ? 0 : $total;
    }

    public static function fetchUserLearnWordInCategories($category_id)
    {
        $user_id = Phalcon\DI::getDefault()->getSession()->get('user_id');
        $sql = "SELECT t4.* FROM lessons t1, lesson_words t2, words t3, answers t4 
                WHERE t1.id=t2.lesson_id AND t2.word_id=t3.id AND t2.answer_id=t4.id AND t4.correct=1 
                AND t1.user_id={$user_id} AND t3.category_id={$category_id} GROUP BY t4.word_id";
        $result = new Resultset(null, $words = new Words(), $words->getReadConnection()->query($sql));
        return count($result);
    }

    public static function fetchByCategoryId($category_id)
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->from('Words')
            ->where('category_id=:category_id:', ['category_id' => $category_id])
            ->getQuery()
            ->execute();
    }

    public static function fetchUserLearnWords()
    {
        $user_id = Phalcon\DI::getDefault()->getSession()->get('user_id');
        $sql = "SELECT t4.* FROM lessons t1, lesson_words t2, words t3, answers t4 
                WHERE t1.id=t2.lesson_id AND t2.word_id=t3.id AND t2.answer_id=t4.id AND t4.correct=1 
                AND t1.user_id={$user_id} GROUP BY t4.word_id";
        $result = new Resultset(null, $words = new Words(), $words->getReadConnection()->query($sql));
        return count($result);
    }

}
