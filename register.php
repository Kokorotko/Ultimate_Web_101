<?php
session_start();
require_once("Db.php"); /*database shit*/
Db::connect('sql5.webzdarma.cz', 'kamilfranekw6956', 'kamilfranekw6956', 'QLlF4@g#5#&kCc%F)$@7');
if ($_POST)
{
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    Db::insert('weather_users', 
    [
        'email' => $_POST['email'],
        'name' => $_POST['name'],
        'password' => $password
    ]);
    $_SESSION['user_id'] = Db::getLastId();
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <style>
        body {
            font-family: 'Comic Sans MS', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .form-container .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registrace</h2>
        <form action="register.php" method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
            <label for="name">Name</label>
            <input type="name" id="name" name="name" required>
            <label for="password">Heslo</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Registrovat se</button>
        </form>
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <button type="submit">Login</button>
        </form>    
    </div>
</body>
</html>
