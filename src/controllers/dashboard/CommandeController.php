<?php
class CommandeController {
    private $commandeModel;
    private $view;

    public function __construct($db) {
        $this->commandeModel = new Commande($db);
        $this->view = new View();
    }

    public function index() {
        $commandes = $this->commandeModel->getAll();
        $this->view->render('dashboard/commandes/index', ['commandes' => $commandes]);
    }

    public function show($id) {
        $commande = $this->commandeModel->getById($id);
        if (!$commande) {
            header('Location: /dashboard/commandes?error=1');
            exit;
        }

        $details = $this->commandeModel->getDetails($id);
        $this->view->render('dashboard/commandes/show', [
            'commande' => $commande,
            'details' => $details
        ]);
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            
            if ($this->commandeModel->updateStatus($id, $status)) {
                header('Location: /dashboard/commandes?success=1');
            } else {
                header('Location: /dashboard/commandes?error=1');
            }
            exit;
        }
    }

    public function delete($id) {
        if ($this->commandeModel->delete($id)) {
            header('Location: /dashboard/commandes?success=1');
        } else {
            header('Location: /dashboard/commandes?error=1');
        }
        exit;
    }
} 