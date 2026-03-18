<?php

$url = 'http://localhost:8000/api/login';
$data = ['username' => 'director', 'password' => 'password123'];

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\nAccept: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data),
        'ignore_errors' => true // to capture 4xx/5xx responses
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo "Error communicating with server.\n";
}
else {
    echo "Response:\n$result\n";
}
