<?php

$token = 'secret';

// check token in every request
if ($_GET['token'] !== $token) {
    header('HTTP/1.0 401 Unauthorized');
    exit();
}

// verification request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    exit($_GET['challenge']);
}

// https://stackoverflow.com/a/8945912/2378095
// access the entity body of a POST request
$data = json_decode(file_get_contents('php://input')); // request body

header('Content-Type: application/json');

$data = array(
    'responses' => array(
        array(
            'type' => 'text',
            'elements' => array('Ok, no problem')
        )
    )
);

echo json_encode($data);
