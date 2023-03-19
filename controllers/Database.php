<?php
require_once __DIR__ . '/DatabaseProvider.php';

class Database
{

    /**
     * Сохранение короткой ссылки
     *
     * @param string $token
     * @param string $url
     * @return void
     */
    public function saveURL(string $token, string $url): void
    {
        $data = array( 'token' => $token, 'url' => $url);
        $query = DatabaseProvider::getDb()->prepare("INSERT INTO short_url (TOKEN, URL) values (:token, :url)");
        $query->execute($data);
    }

    /**
     * Проверка наличия короткой ссылки
     *
     * @param string $url
     * @return mixed
     */
    public function existenceURL(string $url)
    {
        $stmt  = DatabaseProvider::getDb()->prepare("SELECT * FROM short_url WHERE URL = :url");
        $stmt->execute(['url' => $url]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Проверка совпадения токена
     *
     * @param string $token
     * @return mixed
     */
    public function existenceToken(string $token)
    {
        $stmt  = DatabaseProvider::getDb()->prepare("SELECT * FROM short_url WHERE TOKEN = :token");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
