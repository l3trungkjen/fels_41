<?php
use Phalcon\Forms\Element\Select;

class AnswersController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->sidebar = false;
    }

    public function newAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        $words = Words::find();
        $select = new Select('word_id');
        $arr_word[''] = 'Please, Choose one word...';
        foreach ($words as $word) {
            $arr_word[$word->id] = $word->name;
        }
        $select->setOptions($arr_word);

        $select_correct = new Select('correct');
        $select_correct->setOptions(['0' => 'InCorrect', '1' => 'Correct']);

        $this->view->words = $select->render(['class' => 'span12']);
        $this->view->correct = $select_correct->render(['class' => 'span12']);
        $this->view->sidebar = false;
    }

    public function createAction()
    {
        if (!empty($request = $this->request->getPost())) {
            $answer = new Answers();
            if (!$answer->save($request)) {
                foreach ($answer->getMessages() as $key => $message) {
                    $this->flash->error($message);
                    break;
                }
            } else {
                $this->flash->success('Create answer success!!');
            }
        }
        $this->view->sidebar = false;
        return $this->dispatcher->forward(
            [
                'controller' => 'answers',
                'action' => 'new'
            ]
        );
    }

    public function editAction($id)
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        if (!isset($id)) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'answers',
                    'action' => 'view'
                ]
            );
        } else {
            $answer = Answers::findFirst($id);
            $this->tag->setDefault('id', $answer->id);
            $this->tag->setDefault('name', $answer->name);
            $words = Words::find();
            $select_word = new Select('word_id');
            $arrWord[''] = 'Please, Choose one word...';
            foreach ($words as $word) {
                if ($word->id === $answer->word_id) {
                    $select_word->setDefault($word->id);
                }
                $arrWord[$word->id] = $word->name;
            }
            $select_word->setOptions($arrWord);

            $select_correct = new Select('correct');
            $select_correct->setOptions(['0' => 'InCorrect', '1' => 'Correct']);
            $select_correct->setDefault($answer->correct);
        }
        $this->view->words = $select_word->render(['class' => 'span12']);
        $this->view->correct = $select_correct->render(['class' => 'span12']);
        $this->view->sidebar = false;
    }

    public function saveAction()
    {
        if (!empty($request = $this->request->getPost())) {
            $answer = Answers::findFirstById($request['id']);
            $answer->id = $request['id'];
            $answer->word_id = $request['word_id'];
            $answer->name = $request['name'];
            $answer->correct = $request['correct'];
            if ($answer->save()) {
                $this->flash->success('Answer was edit success!!!');
            } else {
                foreach ($answer->getMessages() as $key => $message) {
                    $this->flash->error($message);
                }
                $this->flash->error('Word was edit error!!!');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'answers',
                        'action' => 'edit',
                        'params' => [$answer->id]
                    ]
                );
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'answers',
                'action' => 'view'
            ]
        );
    }

    public function deleteAction($id)
    {
        if (!$this->session->has('user_id') && !$this->session->has('user_email')) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
        if (!isset($id)) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'answers',
                    'action' => 'view'
                ]
            );
        } else {
            $answer = Answers::findFirst($id);
            if (!$answer) {
                $this->flash->error('Answer was not found.');
            } else {
                if (!$answer->delete()) {
                    foreach ($answer->getMessages() as $key => $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $this->flash->success('Answer was deleted success.');
                }
            }
            return $this->dispatcher->forward([
                'controller' => 'answers',
                'action' => 'view'
            ]);
        }
        $this->view->sidebar = false;
    }

    public function viewAction()
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
                'data' => Answers::fetchAll(),
                'limit' => 5,
                'page' => $currentPage
            ]
        );
        $this->view->answers = $paginator->getPaginate();
        $this->view->sidebar = false;
    }

}

