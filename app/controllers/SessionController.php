<?php

class SessionController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        
    }

    public function createAction()
    {
        if (!empty($this->session->has('user_id')) && !empty($this->session->has('user_email'))) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        if (!empty($request = $this->request->getPost())) {
            $user = Users::findFirst(
                [
                    'email=:email: AND password=:password:',
                    'bind' => [
                        'email' => $request['email'],
                        'password' => $request['password']
                    ]
                ]
            );
            if ($user) {
                $this->session->set('user_id', $user->id);
                $this->session->set('user_email', $user->email);
                return $this->dispatcher->forward(
                    [
                        'controller' => 'index',
                        'action' => 'index'
                    ]
                );
            } else {
                $this->flash->error('Email or Password incorrect.');
                return $this->dispatcher->forward(
                        [
                        'controller' => 'session',
                        'action' => 'new'
                    ]
                );
            }
        }
    }

    public function newAction()
    {
        if (!(empty($this->session->has('user_id'))) && !(empty($this->session->has('user_email')))) {
            return $this->response->redirect('index');
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
    }
}

