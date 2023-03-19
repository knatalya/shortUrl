<?php
require_once  __DIR__ . '/controllers/Database.php';

header('Content-Type: text/html; charset= utf-8');

$key = $_GET['key'];

if(isset($key) && !empty($key)) {
    $db = new Database();
    if(!empty(($db->existenceToken($_GET['key']))['TOKEN'])) {
        header('Location: ' . ($db->existenceToken($key))['URL']);
    }
} else { ?>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/src/css/style.css">
            <link rel="icon" href="favicon.ico">
            <title>Короткая ссылка</title>
        </head>
        <body>
        <section class="container">
            <h1 class="header">Короткая ссылка</h1>
            <p class="description">Помогите клиентам быстро найти вашу страницу в интернете. Благодаря короткой ссылке клиентам не придётся видеть длинные url-адреса занимающие много места. Достаточно скопировать ссылку сервиса.</p>
            <form class="form">
                <input type="text" name="url" id="url" placeholder="Введите ссылку, которую можно сократить" required />
                <div class="submit" id="submit">Сократить</div>
            </form>
            <div class="result"></div>
            <div class="error"></div>
        </section>
        <script type="text/javascript" src="src/js/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="src/js/script.js"></script>
        </body>
    </html>
<? } ?>
