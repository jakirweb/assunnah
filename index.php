<?php

require_once 'config.php';

$error = '';


// ================================
// LOGOUT
// ================================

if (isset($_GET['logout'])) {

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    header('Location: index.php');
    exit;
}


// ================================
// LOGIN
// ================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (
        APP_PASSWORD !== '' &&
        hash_equals(APP_USERNAME, $username) &&
        hash_equals(APP_PASSWORD, $password)
    ) {

        session_regenerate_id(true);

        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        header('Location: index.php');
        exit;
    }

    $error = 'Username অথবা Password ভুল!';
}


$loggedIn = $_SESSION['logged_in'] ?? false;

?>

<!DOCTYPE html>

<html lang="bn">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>PHP Web App</title>

<style>

* {
    box-sizing: border-box;
}

body {

    margin: 0;

    min-height: 100vh;

    font-family:
        Arial,
        "Noto Sans Bengali",
        sans-serif;

    background: #f1f5f9;

    display: flex;

    align-items: center;

    justify-content: center;
}


.box {

    width: 100%;

    max-width: 400px;

    background: #ffffff;

    padding: 30px;

    border-radius: 14px;

    box-shadow:
        0 10px 30px rgba(0,0,0,.10);
}


h2 {

    text-align: center;

    margin-top: 0;

    margin-bottom: 25px;
}


label {

    display: block;

    margin-bottom: 5px;

    font-weight: bold;
}


input {

    width: 100%;

    padding: 13px;

    margin-bottom: 16px;

    border: 1px solid #d1d5db;

    border-radius: 8px;

    font-size: 16px;

    outline: none;
}


input:focus {

    border-color: #2563eb;
}


button {

    width: 100%;

    padding: 13px;

    border: none;

    border-radius: 8px;

    background: #2563eb;

    color: white;

    font-size: 16px;

    cursor: pointer;
}


button:hover {

    background: #1d4ed8;
}


.error {

    background: #fee2e2;

    color: #991b1b;

    padding: 10px;

    border-radius: 8px;

    margin-bottom: 18px;

    text-align: center;
}


.success {

    text-align: center;
}


.logout {

    display: inline-block;

    margin-top: 20px;

    padding: 10px 20px;

    border-radius: 8px;

    background: #dc2626;

    color: white;

    text-decoration: none;
}

</style>

</head>


<body>


<div class="box">


<?php if (!$loggedIn): ?>


<h2>Login</h2>


<?php if ($error): ?>

<div class="error">

<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>

</div>

<?php endif; ?>


<form method="POST">


<label>
Username
</label>

<input
    type="text"
    name="username"
    required
    autocomplete="username"
>


<label>
Password
</label>

<input
    type="password"
    name="password"
    required
    autocomplete="current-password"
>


<button type="submit">
    Login
</button>


</form>


<?php else: ?>


<div class="success">

<h2>
    Welcome!
</h2>


<p>
    Login successful.
</p>


<p>

Username:

<strong>
<?= htmlspecialchars(
    $_SESSION['username'],
    ENT_QUOTES,
    'UTF-8'
) ?>
</strong>

</p>


<a
    class="logout"
    href="?logout=1"
>
    Logout
</a>


</div>


<?php endif; ?>


</div>


</body>

</html>
