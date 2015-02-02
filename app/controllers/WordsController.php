<?php
use Phalcon\Forms\Element\Select;

class WordsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->sidebar = false;
    }

    public function newAction()
    {
        $categories = Categories::find(
            [
                'status=1'
            ]
        );
        $select = new Select('category_id');
        $arr_category[''] = 'Please, Choose one category...';
        foreach ($categories as $category) {
            $arr_category[$category->id] = $category->name;
        }
        $select->setOptions($arr_category);
        $this->view->categories = $select->render(['class' => 'span12']);
        $this->view->sidebar = false;
    }

    public function createAction()
    {
        if (!empty($request = $this->request->getPost())) {
            $words = new Words();
            if (!$words->save($request)) {
                foreach ($words->getMessages() as $key => $message) {
                    $this->flash->error($message);
                    break;
                }
            } else {
                $this->flash->success('Create word success!!');
            }
        }
        $this->view->sidebar = false;
        return $this->dispatcher->forward(
            [
                'controller' => 'words',
                'action' => 'new'
            ]
        );
    }

    public function editAction($id)
    {
        if (!isset($id)) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'words',
                    'action' => 'view'
                ]
            );
        } else {
            $word = Words::findFirst($id);
            $this->tag->setDefault('id', $word->id);
            $this->tag->setDefault('name', $word->name);
            $this->tag->setDefault('mean', $word->mean);
            $categories = Categories::find(
                [
                    'status=1'
                ]
            );
            $select = new Select('category_id');
            $arrCategory[''] = 'Please, Choose one category...';
            foreach ($categories as $category) {
                if ($category->id === $word->category_id) {
                    $select->setDefault($category->id);
                }
                $arrCategory[$category->id] = $category->name;
            }
            $select->setOptions($arrCategory);
        }
        $this->view->categories = $select->render(['class' => 'span12']);
        $this->view->sidebar = false;
    }

    public function saveAction()
    {
        if (!empty($request = $this->request->getPost())) {
            $word = Words::findFirst($request['id']);
            $word->id = $request['id'];
            $word->name = $request['name'];
            $word->mean = $request['mean'];
            $word->category_id = $request['category_id'];
            if ($word->save()) {
                $this->flash->success('Word was edit success!!!');
            } else {
                foreach ($word->getMessages() as $key => $message) {
                    $this->flash->error($message);
                }
                $this->flash->error('Word was edit error!!!');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'words',
                        'action' => 'edit',
                        'params' => [$word->id]
                    ]
                );
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'words',
                'action' => 'view'
            ]
        );
    }

    public function deleteAction($id)
    {
        if (!isset($id)) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'words',
                    'action' => 'view'
                ]
            );
        } else {
            $word = Words::findFirst($id);
            if (!$word) {
                $this->flash->error('Word was not found.');
            } else {
                if (!$word->delete()) {
                    foreach ($word->getMessages() as $key => $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $this->flash->success('Word was deleted success.');
                }
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'words',
                    'action' => 'view'
                ]
            );
        }
        $this->view->sidebar = false;
    }

    public function viewAction()
    {
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                'data' => Words::fetchAll(),
                'limit' => 5,
                'page' => $currentPage
            ]
        );
        $this->view->words = $paginator->getPaginate();
        $this->view->sidebar = false;
    }
}

