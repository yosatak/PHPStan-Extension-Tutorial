<?php
declare(strict_types=1);

if (!isset($_GET['id'])) {
    http_response_code(404);
    echo '404 Not Found';
    die;
}

var_dump($_GET['id']);

if (!preg_match('/\A[0-9]+\z/',$_GET['id'])) {
    http_response_code(404);
    echo '404 Not Found';
    die;
}

echo "hello {$_GET['id']}";
