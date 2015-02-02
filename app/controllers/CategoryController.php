<?php

class CategoryController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        // Categories::fetchAll();
        $categories = Categories::find();
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                'data' => $categories,
                'limit' => 5,
                'page' => $currentPage
            ]
        );
        $this->view->categories = $paginator->getPaginate();
        $this->view->user_id = $this->session->get('user_id');
        $this->view->sidebar = false;
    }

    public function newAction()
    {
        $this->view->sidebar = false;
    }

    public function createAction()
    {
        if (!empty($request = $this->request->getPost())) {
            $categories = new Categories();
            $categories->created = date('Y-m-d H:i:s');
            $categories->status = 1;
            if (!$categories->save($request)) {
                foreach ($categories->getMessages() as $key => $message) {
                    $this->flash->error($message);
                    break;
                }
            } else {
                $this->flash->success('Create category success!!');
            }
        }
        $this->view->sidebar = false;
    }

    public function editAction($id)
    {
        if (!isset($id)) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'category',
                    'action' => 'view'
                ]
            );
        } else {
            $category = Categories::findFirst($id);
            $this->tag->setDefault('id', $category->id);
            $this->tag->setDefault('name', $category->name);
            $this->view->sidebar = false;
        }
    }

    public function saveAction() {
        if (!empty($request = $this->request->getPost())) {
            $category = Categories::findFirst($request['id']);
            $category->id = $request['id'];
            $category->name = $request['name'];
            if ($category->save()) {
                $this->flash->success('Category was edit success!!!');
            } else {
                foreach ($category->getMessages() as $key => $message) {
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(
                    [
                        'controller' => 'category',
                        'action' => 'edit',
                        'params' => [$category->id]
                    ]
                );
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'category',
                'action' => 'view'
            ]
        );
    }

    public function deleteAction($id)
    {
        if (!isset($id)) {
            return $this->dispatcher->forward(
                [
                    'controller' => 'category',
                    'action' => 'view'
                ]
            );
        } else {
            $category = Categories::findFirst($id);
            if (!$category) {
                $this->flash->error('Category was not found.');
            } else {
                if (!$category->delete()) {
                    foreach ($category->getMessages() as $key => $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $this->flash->success('Category was deleted success.');
                }
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'category',
                    'action' => 'view'
                ]
            );
        }
    }

    public function viewAction()
    {
        $categories = Categories::find();
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            [
                'data' => $categories,
                'limit' => 5,
                'page' => $currentPage
            ]
        );
        $this->view->categories = $paginator->getPaginate();
        $this->view->sidebar = false;
    }

    public function lessonAction($id = '')
    {
        if (!empty($id)) {
            $lessons = new Lessons();
            $lessons->user_id = $this->session->get('user_id');
            $lessons->category_id = $id;
            $lessons->created = date('Y-m-d H:i:s');
            if (!$lessons->save()) {
                foreach ($lessons->getMessages() as $key => $message) {
                    $this->flash->error($message);
                    break;
                }
            } else {
                $words = Words::fetchByCategoryId($id);
                $this->view->lesson_id = $lessons->id;
                $this->view->words = $words;
                $this->view->answers = new Answers();
            }
        }
        $this->view->sidebar = false;
    }

    public function lesson_saveAction()
    {
        if (!empty($request = $this->request->getPost())) {
            foreach ($request['answer'] as $key => $answer) {
                $lesson_words = new LessonWords();
                $lesson_words->lesson_id = $request['lesson_id'];
                $lesson_words->word_id = $key;
                $lesson_words->answer_id = $answer;
                if (!$lesson_words->save()) {
                    foreach ($lesson_words->getMessages() as $key => $message) {
                        $this->flash->error($message);
                    }
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'category',
                            'action' => 'index',
                        ]
                    );
                }
            }
            $this->flash->success('Lesson finish!!!');
            return $this->dispatcher->forward(
                [
                    'controller' => 'category',
                    'action' => 'index',
                ]
            );
        }
    }
}

