<?php

require_once 'config.php';

header(
    'Content-Type: application/json; charset=utf-8'
);


// ================================
// API KEY CHECK
// ================================

$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';


// API key যদি configure করা না থাকে
// তাহলে API বন্ধ থাকবে।

if (API_KEY === '') {

    http_response_code(503);

    echo json_encode(
        [
            'success' => false,
            'message' => 'API is not configured'
        ],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}


if (!hash_equals(API_KEY, $apiKey)) {

    http_response_code(401);

    echo json_encode(
        [
            'success' => false,
            'message' => 'Invalid API Key'
        ],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}


// ================================
// ACTION
// ================================

$action = $_GET['action'] ?? 'test';


switch ($action) {


    // ============================
    // TEST
    // ============================

    case 'test':

        echo json_encode(
            [
                'success' => true,

                'message' =>
                    'PHP API is working!',

                'time' =>
                    date('Y-m-d H:i:s')
            ],
            JSON_UNESCAPED_UNICODE
        );

        break;


    // ============================
    // USER
    // ============================

    case 'user':

        echo json_encode(
            [
                'success' => true,

                'username' =>
                    $_SESSION['username'] ?? null,

                'logged_in' =>
                    $_SESSION['logged_in'] ?? false
            ],
            JSON_UNESCAPED_UNICODE
        );

        break;


    // ============================
    // UNKNOWN ACTION
    // ============================

    default:

        http_response_code(400);

        echo json_encode(
            [
                'success' => false,

                'message' =>
                    'Unknown action'
            ],
            JSON_UNESCAPED_UNICODE
        );
}
