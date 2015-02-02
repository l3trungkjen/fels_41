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
        $this->view->sidebar = true;
        $this->view->user = $user;
        $this->view->learn_total = Words::fetchUserLearnWords();
    }

}

