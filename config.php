<?php

session_start();


// ================================
// LOGIN SETTINGS
// ================================
// এখানে আপনার username/password রাখবেন না।
// Environment variable থেকে নেওয়া হবে।

define(
    'APP_USERNAME',
    getenv('APP_USERNAME') ?: 'admin'
);

define(
    'APP_PASSWORD',
    getenv('APP_PASSWORD') ?: ''
);


// ================================
// API KEY
// ================================

define(
    'API_KEY',
    getenv('API_KEY') ?: ''
);
