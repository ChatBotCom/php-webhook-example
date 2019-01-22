<?php

$token = 'secret';

// check token in every request
if (!isset($_GET['token']) || $_GET['token'] !== $token) {
    header('HTTP/1.0 401 Unauthorized');
    exit();
}

// verification request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    exit($_GET['challenge']);
}

// access the body of a POST request
$data = json_decode(file_get_contents('php://input'));

header('Content-Type: application/json');

$response = array(
    // return custom attributes object
    'parameters' => array(
        'name' => 'John',
        'surname' => 'Example'
    ),
    // return responses
    'responses' => array(
        array(
            'type' => 'text',
            'elements' => array('Hi {{name}} {{surname}}')
        )
    )
);

echo json_encode($response);

?>
