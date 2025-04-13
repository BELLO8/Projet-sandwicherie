<?php

class SlideController
{
    private $slideModel;
    private $view;

    public function __construct($db)
    {
        $this->slideModel = new Slide($db);
        $this->view = new View();
    }

    public function index()
    {
        $slides = $this->slideModel->getAll();
        $this->view->render('dashboard/slides/index', ['slides' => $slides]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $position = $_POST['position'] ?? 0;
            $image = $this->handleImageUpload($_FILES['image'] ?? null);

            if ($this->slideModel->create($title, $description, $image, $position)) {
                header('Location: /dashboard/slides?success=1');
                exit;
            }
        }
        $this->view->render('dashboard/slides/create');
    }

    public function edit($id)
    {
        $slide = $this->slideModel->getById($id);
        if (!$slide) {
            header('Location: /dashboard/slides?error=1');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $position = $_POST['position'] ?? 0;
            $image = $this->handleImageUpload($_FILES['image'] ?? null);

            if ($this->slideModel->update($id, $title, $description, $image, $position)) {
                header('Location: /dashboard/slides?success=1');
                exit;
            }
        }

        $this->view->render('dashboard/slides/edit', ['slide' => $slide]);
    }

    public function delete($id)
    {
        if ($this->slideModel->delete($id)) {
            header('Location: /dashboard/slides?success=1');
        } else {
            header('Location: /dashboard/slides?error=1');
        }
        exit;
    }

    public function updatePositions()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $positions = $_POST['positions'] ?? [];

            if ($this->slideModel->updatePositions($positions)) {
                header('Location: /dashboard/slides?success=1');
            } else {
                header('Location: /dashboard/slides?error=1');
            }
            exit;
        }
    }

    private function handleImageUpload($file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $uploadDir = 'uploads/slides/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $targetPath;
        }
        return null;
    }
}
