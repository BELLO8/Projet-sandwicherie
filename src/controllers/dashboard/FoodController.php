<?php
class FoodController {
    private $foodModel;
    private $categoryModel;
    private $view;

    public function __construct($db) {
        $this->foodModel = new Food($db);
        $this->categoryModel = new Category($db);
        $this->view = new View();
    }

    public function index() {
        $foods = $this->foodModel->getAll();
        $categories = $this->categoryModel->getAll();
        $this->view->render('dashboard/foods/index', [
            'foods' => $foods,
            'categories' => $categories
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            $image = $this->handleImageUpload($_FILES['image'] ?? null);

            if ($this->foodModel->create($name, $description, $price, $image, $category_id)) {
                header('Location: /dashboard/foods?success=1');
                exit;
            }
        }
        $categories = $this->categoryModel->getAll();
        $this->view->render('dashboard/foods/create', ['categories' => $categories]);
    }

    public function edit($id) {
        $food = $this->foodModel->getById($id);
        if (!$food) {
            header('Location: /dashboard/foods?error=1');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            $image = $this->handleImageUpload($_FILES['image'] ?? null);

            if ($this->foodModel->update($id, $name, $description, $price, $image, $category_id)) {
                header('Location: /dashboard/foods?success=1');
                exit;
            }
        }

        $categories = $this->categoryModel->getAll();
        $this->view->render('dashboard/foods/edit', [
            'food' => $food,
            'categories' => $categories
        ]);
    }

    public function delete($id) {
        if ($this->foodModel->delete($id)) {
            header('Location: /dashboard/foods?success=1');
        } else {
            header('Location: /dashboard/foods?error=1');
        }
        exit;
    }

    private function handleImageUpload($file) {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $uploadDir = 'uploads/foods/';
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