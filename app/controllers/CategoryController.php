<?php

class CategoryController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function addAction()
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
                $this->flash->success('Create categories success!!');
            }
        }
        $this->view->sidebar = false;
    }

    public function editAction($id)
    {
        $category = Categories::findFirstById($id);
        $category->tag->setDefault('id', $category->id);
        $category->tag->setDefault('name', $category->name);
    }

    public function viewAction()
    {
        $categories = Categories::find();
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            'data' => $categories,
            'limit' => 5,
            'page' => $currentPage
        ));
        $this->view->categories = $paginator->getPaginate();
        $this->view->sidebar = false;
    }
}

