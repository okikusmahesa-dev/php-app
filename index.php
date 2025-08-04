<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/products':
        require __DIR__ . '/api/products.php';
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
        break;
}
