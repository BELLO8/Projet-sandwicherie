<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/Router.php';
require_once __DIR__ . '/../controllers/PublicationController.php';
require_once __DIR__ . '/../controllers/dashboard/CategoryController.php';
require_once __DIR__ . '/../controllers/dashboard/SlideController.php';
require_once __DIR__ . '/../models/Publication.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Slide.php';

// Initialiser le routeur
$router = new Router();

// Routes pour le dashboard
$router->addRoute('GET', '/dashboard/categories', 'CategoryController', 'index');
$router->addRoute('GET', '/dashboard/categories/create', 'CategoryController', 'create');
$router->addRoute('POST', '/dashboard/categories/create', 'CategoryController', 'create');
$router->addRoute('GET', '/dashboard/categories/{id}/edit', 'CategoryController', 'edit');
$router->addRoute('POST', '/dashboard/categories/{id}/edit', 'CategoryController', 'edit');
$router->addRoute('POST', '/dashboard/categories/{id}/delete', 'CategoryController', 'delete');

$router->addRoute('GET', '/dashboard/slides', 'SlideController', 'index');
$router->addRoute('GET', '/dashboard/slides/create', 'SlideController', 'create');
$router->addRoute('POST', '/dashboard/slides/create', 'SlideController', 'create');
$router->addRoute('GET', '/dashboard/slides/{id}/edit', 'SlideController', 'edit');
$router->addRoute('POST', '/dashboard/slides/{id}/edit', 'SlideController', 'edit');
$router->addRoute('POST', '/dashboard/slides/{id}/delete', 'SlideController', 'delete');

// Dispatcher la requête
$router->dispatch();