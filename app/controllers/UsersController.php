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

    public function avatarAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        $this->view->user = Users::findFirst($this->session->get('user_id'));
        $this->view->sidebar = false;
    }

    public function upload_avatarAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        if (!empty($request = $this->request->getPost())) {
            if (!Users::uploadImage()) {
                $this->flash->error('Avatar was edit error!!!');
            } else {
                $user = Users::findFirst($request['id']);
                $user->id = $request['id'];
                $user->avatar = Users::uploadImage();
                if ($user->save()) {
                    $this->flash->success('Avatar was edit success!!!');
                } else {
                    foreach ($user->getMessages() as $key => $message) {
                        $this->flash->error($message);
                    }
                }
            }
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
    }

    public function show_allAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                'data' => Users::fetchDifferentUserId($this->session->get('user_id')),
                'limit' => 20,
                'page' => $currentPage
            ]
        );
        $this->view->users = $paginator->getPaginate();
        $this->view->sidebar = false;
    }

    public function followAction($friend_id)
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        if (!empty($friend_id) && is_int(intval($friend_id))) {
            $follow = Follows::fetchDataFriend($friend_id);
            if (count($follow) > 0) {
                if (!$follow->delete()) {
                    return false;
                }
            } else {
                $add_follow = new Follows();
                $add_follow->user_id = $this->session->get('user_id');
                $add_follow->friend_id = $friend_id;
                $add_follow->status = 1;
                if (!$add_follow->save()) {
                    return false;
                }
            }
            $currentPage = $this->request->getQuery('page', 'int', 1);
            $paginator = new \Phalcon\Paginator\Adapter\Model(
                [
                    'data' => Users::fetchDifferentUserId($this->session->get('user_id')),
                    'limit' => 20,
                    'page' => $currentPage
                ]
            );
            $this->view->users = $paginator->getPaginate();
            $this->view->sidebar = false;
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
    }

}

