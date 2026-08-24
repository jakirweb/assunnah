<?php

// ===== LOGIN CONFIGURATION =====
define('APP_USERNAME', 'admin');
define('APP_PASSWORD', '123456');

// Session
session_start();


// ===== API SECURITY KEY =====
// api.php থেকে request করার সময় এই key ব্যবহার করতে পারবেন।
define('API_KEY', 'CHANGE_THIS_TO_A_SECRET_KEY');


// ===== DATABASE =====
// এই version-এ database প্রয়োজন নেই.
// পরে চাইলে MySQL যোগ করা যাবে.
