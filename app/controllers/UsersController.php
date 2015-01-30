<?php

class UsersController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function newAction()
    {

    }

    public function createAction()
    {
        $request = $this->request->getPost();
        $users = new Users();
        if (!empty($request)) {
            $users->created = date('Y-m-d H:i:s');
            if (!$users->save($request)) {
                foreach ($users->getMessages() as $key => $message) {
                    $this->flash->error($message);
                    break;
                }
            } else {
                $this->flash->success('Create user success!!!');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'users',
                    'action' => 'new'
                ]
            );
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'users',
                'action' => 'new'
            ]
        );
    }
}

