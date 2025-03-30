<?php
require_once '../vendor/autoload.php';
require_once '/var/www/cesi-demosk/git/cesi-site/Controllers/EntrepriseController.php';




// Configuration de Twig
$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Mettre '../cache' en production
    'debug' => true
]);

// Ajouter l'extension de débogage pour le développement
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Routage simple
$route = $_GET['route'] ?? 'entreprises';

switch ($route) {
    case 'entreprises':
        $controller = new EntrepriseController($twig);
        $controller->index();
        break;
    case 'entreprise_create':
        $controller = new EntrepriseController($twig);
        $controller->create();
        break;
    default:
        // Page 404 ou redirection
        header('Location: index.php?route=entreprises');//test
        exit;
}
