<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            $this->dispatcher->forward(
                [
                    'controller' => 'session',
                    'action' => 'new',
                ]
            );
        }
        $user = Users::findFirst($this->session->get('user_id'));
        $follows = Follows::fetchUserId($this->session->get('user_id'));
        $str = '';
        foreach ($follows as $key => $follow) {
            $str .= " OR user_id='{$follow->friend_id}'";
        }
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                'data' => Lessons::fetchByUserId($str),
                'limit' => 15,
                'page' => $currentPage
            ]
        );
        $this->view->user = $user;
        $this->view->lessons = $paginator->getPaginate();
        $this->view->learn_total = Words::fetchUserLearnWords();
        $this->view->sidebar = true;
    }

}

