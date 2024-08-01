<?php

use Dbseller\ProjetoInicial\Infra\Persistence\DBConnection;
use Dbseller\ProjetoInicial\Repository\ProductRepository;

require 'vendor/autoload.php';

$pdo = DBConnection::createConnection();
$productRepository = new ProductRepository($pdo);
$productRepository->deleteProduct($_POST['id']);

header('Location: admin.php');
