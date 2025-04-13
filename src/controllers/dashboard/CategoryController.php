<?php

class CategoryController
{
    private $categoryModel;
    private $view;

    public function __construct()
    {
        $this->categoryModel = new Category();
        $this->view = new View();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();
        $this->view->render('dashboard/categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            if ($this->categoryModel->create($name)) {
                header('Location: /dashboard/categories?success=1');
            } else {
                header('Location: /dashboard/categories?error=1');
            }
            exit();
        }
        require_once 'src/views/dashboard/categories/create.php';
    }

    public function edit($id)
    {
        $category = $this->categoryModel->getById($id);
        if (!$category) {
            header('Location: /dashboard/categories');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            if ($this->categoryModel->update($id, $name)) {
                header('Location: /dashboard/categories?success=1');
            } else {
                header('Location: /dashboard/categories?error=1');
            }
            exit();
        }
        require_once 'src/views/dashboard/categories/edit.php';
    }

    public function delete($id)
    {
        if ($this->categoryModel->delete($id)) {
            header('Location: /dashboard/categories?success=1');
        } else {
            header('Location: /dashboard/categories?error=1');
        }
        exit();
    }
}