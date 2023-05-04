<?php

class DB_Class
{
    // Данные для подключения к базе данных
    var $hostname = "192.168.0.2";
    var $username = "begetuser";
    var $password = "1";
    var $database = "mydb";

    // define('MYSQL_SERVER', '192.168.0.2:3306');
    // define('MYSQL_USER', 'a1');
    // define('MYSQL_PASSWORD', '1');
    // define('MYSQL_DB', 'vesna');

    // var $hostname = "localhost";
    // var $username = "root";
    // var $password = "1";
    // var $database = "mydb";

    // Переменные
    var $conn; // подключенная БД

    function connect()
    {
        // Создаем подключение к базе данных
        $this->conn = mysql_connect($this->hostname, $this->username, $this->password, $this->database);
        // Проверяем, удалось ли подключиться к базе данных
        if (!$this->conn) {
            die("Подключение не удалось: " . mysql_connect_error());
        }
        return $this->conn;
    }

    function close()
    {
        mysql_close($this->conn);
    }
}

?>