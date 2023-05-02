<?php

class DB_Class
{
    // Данные для подключения к базе данных
    var $hostname = "localhost";
    var $username = "root";
    var $password = "1";
    var $database = "mydb";

    function connect()
    {
        // Создаем подключение к базе данных
        $conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        // Проверяем, удалось ли подключиться к базе данных
        if (!$conn) {
            die("Подключение не удалось: " . mysqli_connect_error());
        }
        return $conn;
    }
}

?>