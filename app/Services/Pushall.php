<?php

namespace App\Services;

class Pushall
{
    private $id;
    private $apiKey;

    protected $url = "https://pushall.ru/api.php";

    public function __construct($id, $apiKey)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    public function send($title, $txt)
    {
        $data = [
            "type" => "self",
            "id" => $this->id,
            "key" => $this->apiKey,
            "text" => $title,
            "title" => $txt,
        ];

        curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL => $this->url,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $result = curl_exec($ch); //получить ответ или ошибку
        curl_close($ch);
        return $result;
    }
}
