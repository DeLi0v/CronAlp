<?php

class DB_Class
{
    // Данные для подключения к базе данных
    // var $hostname = "192.168.0.2";
    // var $username = "begetuser";
    // var $password = "1";
    // var $database = "mydb";

    // var $hostname = "localhost";
    // var $username = "root";
    // var $password = "1";
    // var $database = "mydb";

    var $hostname = "db";
    var $username = "root";
    var $password = "1";
    var $database = "SkiResort";

    // Переменные
    var $conn; // подключенная БД

    function connect()
    {
        // Создаем подключение к базе данных
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        // Проверяем, удалось ли подключиться к базе данных
        if (!$this->conn) {
            die("Подключение не удалось: " . mysqli_connect_error());
        }
        return $this->conn;
    }

    function close()
    {
        mysqli_close($this->conn);
    }
}

?>