<?php
use Phalcon\Events\Manager as EventsManager,
    Phalcon\Db\Profiler as DbProfiler;
class LoginController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if (!empty($this->session->has('user_id')) && !empty($this->session->has('user_email'))) {
            return $this->dispatcher->forward(array(
                'controller' => 'index',
                'action' => 'index'
            ));
        }
        if (!empty($request = $this->request->getPost())) {
            $user = Users::findFirst(array(
                'email=:email: AND password=:password:',
                'bind' => array(
                        'email' => $request['email'], 
                        'password' => $request['password']
                    )
            ));
            if ($user) {
                $this->session->set('user_id', $user->id);
                $this->session->set('user_email', $user->email);
                return $this->dispatcher->forward(array(
                    "controller" => "index",
                    "action" => "index"
                ));
            }
        }
    }

}

