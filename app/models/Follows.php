<?php
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Follows extends \Phalcon\Mvc\Model
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
    public $friend_id;

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
            'user_id' => 'user_id', 
            'friend_id' => 'friend_id', 
            'status' => 'status'
        ];
    }

    public static function fetchFriend($friend_id)
    {
        $user_id = Phalcon\DI::getDefault()->getSession()->get('user_id');
        $sql = "SELECT * FROM follows WHERE user_id='{$user_id}' AND friend_id='{$friend_id}' AND status=1";
        return count(new Resultset(null, $follows = new Follows(), $follows->getReadConnection()->query($sql)));
    }

    public static function fetchDataFriend($friend_id)
    {
        $user_id = Phalcon\DI::getDefault()->getSession()->get('user_id');
        $sql = "SELECT * FROM follows WHERE user_id='{$user_id}' AND friend_id='{$friend_id}' AND status=1";
        return new Resultset(null, $follows = new Follows(), $follows->getReadConnection()->query($sql));
    }

    public static function fetchUserId($user_id)
    {
        return \Phalcon\DI::getDefault()->getModelsManager()->createBuilder()
            ->from('Follows')
            ->where('user_id=:user_id:', ['user_id' => $user_id])
            ->getQuery()
            ->execute();
    }

}
