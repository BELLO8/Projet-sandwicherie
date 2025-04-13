<?php
class PublicationController {
    private $publicationModel;
    private $view;

    public function __construct($db) {
        $this->publicationModel = new Publication($db);
        $this->view = new View();
    }

    public function index() {
        $publications = $this->publicationModel->getAll();
        $this->view->render('dashboard/publications/index', ['publications' => $publications]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $image = $this->handleImageUpload($_FILES['image'] ?? null);

            if ($this->publicationModel->create($title, $description, $image)) {
                header('Location: /dashboard/publications?success=1');
                exit;
            }
        }
        $this->view->render('dashboard/publications/create');
    }

    public function edit($id) {
        $publication = $this->publicationModel->getById($id);
        if (!$publication) {
            header('Location: /dashboard/publications?error=1');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $image = $this->handleImageUpload($_FILES['image'] ?? null);

            if ($this->publicationModel->update($id, $title, $description, $image)) {
                header('Location: /dashboard/publications?success=1');
                exit;
            }
        }

        $this->view->render('dashboard/publications/edit', ['publication' => $publication]);
    }

    public function delete($id) {
        if ($this->publicationModel->delete($id)) {
            header('Location: /dashboard/publications?success=1');
        } else {
            header('Location: /dashboard/publications?error=1');
        }
        exit;
    }

    private function handleImageUpload($file) {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $uploadDir = 'uploads/publications/';
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