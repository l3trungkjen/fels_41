<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if (!$this->session->has("user_id") && !$this->session->has("user_email")) {
            $this->dispatcher->forward(array(
                "controller" => "login",
                "action" => 'index',
            ));
        }
        $user = Users::findFirst(array(
            'id=:id:',
            'bind' => array('id' => $this->session->get('user_id'))
        ));
        $this->view->sidebar = true;
        $this->view->user = $user;
    }

}

