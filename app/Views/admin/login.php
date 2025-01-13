<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet"  href="<?= base_url('styleLogin') ?>/css/login.css" />
    <title>Login Dashboard</title>
</head>
<body>
    <main>
        <form action="" method="POST" id="loginForm" class="login-input">
        <h1>Login Dashboard CMS</h1>
            <label for="inputUser">Username</label>
            <input name="user" id="inputUser" type="text" required />
            <label for="inputPassword">Password</label>
            <input name="password" id="inputPassword" type="password" required />
            <button name="login" id="buttonLogin" type="submit">Login</button>
        </form>
    </main>
</body>
</html>