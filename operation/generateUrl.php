<?php
require_once  __DIR__ . '/../controllers/Database.php';

try {

    $db = new Database();

    $url = $_GET['url'];

    if (!empty($url) && filter_var($url, FILTER_VALIDATE_URL)) {
        $token_old = ($db->existenceURL($url))['TOKEN'];
        if(!empty($token_old)) {
            $response = [
                'status'=> true,
                'message'=>$_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/-' . $token_old
            ];
            echo json_encode($response);
        } else {
            $token = bin2hex(random_bytes(3));
            while (($db->existenceToken($token))['TOKEN']) {
                $token = bin2hex(random_bytes(3));
            }
            $db->saveURL($token, $url);
            $response = [
                'status'=> true,
                'message'=>$_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/-' . $token
            ];
            echo json_encode($response);
        }
    } else {
        throw new Exception("Ошибка! Некорректная ссылка!");
    }

} catch (Exception $e) {
    $response = [
        'status'=> false,
        'message'=> $e->getMessage()
    ];
    echo json_encode($response);
}