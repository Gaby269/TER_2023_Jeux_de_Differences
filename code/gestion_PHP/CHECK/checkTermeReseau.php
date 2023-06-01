<?php

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : null;


if ($origin) {
    header('Access-Control-Allow-Origin: ' . $origin);
}

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

$accessControlRequestHeaders = isset( $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']) ?  $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'] : null;

if ($accessControlRequestHeaders) {
    header('Access-Control-Allow-Headers: ' . $accessControlRequestHeaders);
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$word = isset($_GET['word']) ? $_GET['word'] : null;

if (! $word) {
    http_response_code(400);
    exit;
}

// Construction de l'URL de la requête
$params = [
    'gotermsubmit' => 'Chercher',
    'gotermrel' => $word,
    'rel' => '',
    'relin' => 'norelin'
];
$url = "https://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel=$word&rel=";


$curl = curl_init($url);
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => [
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
    ],
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_TIMEOUT => 30,
]);

$response = curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($httpcode !== 200) {
    http_response_code(500);
    exit;
}

if (! $response) {
    http_response_code(500);
    exit;
}

if (strpos($response, "Le terme '$word' n'existe pas !") !== false) {
    echo 'La balise class="jdm-warning" existe.';
} else {
    echo 'La balise n\'existe pas.';
}

http_response_code(200);