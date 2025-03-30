<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Controllers/EntrepriseController.php';

// Activer l'affichage des erreurs (en dev uniquement)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuration de Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Mettre '../cache' en production
    'debug' => true
]);

// Ajouter l'extension de débogage pour le développement
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Routage simple
$route = $_GET['route'] ?? 'entreprises';
$controller = new EntrepriseController($twig);

switch ($route) {
    case 'entreprises':
        $controller->index();
        break;
    case 'entreprise_create':
        $controller->create();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo "Page introuvable";
        break;
}
?>
