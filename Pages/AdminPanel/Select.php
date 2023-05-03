<?php

function SelectTable($table){
require_once("../../connect.php"); // Подключение файла для связи с БД

// Подключение к БД
$db = new DB_Class();
$conn = $db->connect();

// Формируем SQL-запрос для получения данных из таблицы "users"
$sql = "SELECT * FROM ". $table;

// Выполняем SQL-запрос
$result = mysqli_query($conn, $sql);

// Проверим, есть ли записи в таблице
if (mysqli_num_rows($result) > 0) {
    
    echo "<div>";
    // Выводим начало таблицы
    echo "<table>";
    if($table == 'Clients') {
        Clients($result);    
    } elseif($table == 'Staff') {
        Staff($result);
    } elseif($table == 'Services') {
        Services($result);
    } elseif($table == 'Equepments') {
        Equepments($result);
    } elseif($table == 'Ski_Pass') {
        Ski_Pass($result);
    }

    // Выводим конец таблицы
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div class=\"error\">В таблице нет данных.</div>";
}

// Закрываем подключение к базе данных
mysqli_close($conn);
}

// Вывод таблицы клиентов
function Clients($result){
    echo "<tr>
            <th width=\"50\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th width=\"100\">Телефон</th>
            <th width=\"200\">Почта</th>
            <th>Пароль</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["idClient"] . "</td>";
        echo "<td>" . $row["ClientSurname"] . "</td>";
        echo "<td>" . $row["ClientName"] . "</td>";
        echo "<td>" . $row["ClientOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "</tr>";
    }
}

// Вывод таблицы сотрудников
function Staff($result){
    echo "<tr>
            <th width=\"50\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th width=\"100\">Телефон</th>
            <th width=\"200\">Почта</th>
            <th>Должность</th>
            <th>Пароль</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["idStaff"] . "</td>";
        echo "<td>" . $row["StaffSurname"] . "</td>";
        echo "<td>" . $row["StaffName"] . "</td>";
        echo "<td>" . $row["StaffOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Post"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "</tr>";
    }    
}

// Вывод таблицы услуг
// НЕ НАСТРОЕНО
function Services($result){
    echo "<tr>
            <th width=\"50\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th width=\"100\">Телефон</th>
            <th width=\"200\">Почта</th>
            <th>Пароль</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["idClient"] . "</td>";
        echo "<td>" . $row["ClientSurname"] . "</td>";
        echo "<td>" . $row["ClientName"] . "</td>";
        echo "<td>" . $row["ClientOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "</tr>";
    }
}

// Вывод таблицы оборудования
// НЕ НАСТРОЕНО
function Equepments($result){
    echo "<tr>
            <th width=\"50\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th width=\"100\">Телефон</th>
            <th width=\"200\">Почта</th>
            <th>Пароль</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["idClient"] . "</td>";
        echo "<td>" . $row["ClientSurname"] . "</td>";
        echo "<td>" . $row["ClientName"] . "</td>";
        echo "<td>" . $row["ClientOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "</tr>";
    }
}

// Вывод таблицы ски-пассов
// НЕ НАСТРОЕНО
function Ski_Pass($result){
    echo "<tr>
            <th width=\"50\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th width=\"100\">Телефон</th>
            <th width=\"200\">Почта</th>
            <th>Пароль</th>
            <th>Изменить</th>
            <th>Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["idClient"] . "</td>";
        echo "<td>" . $row["ClientSurname"] . "</td>";
        echo "<td>" . $row["ClientName"] . "</td>";
        echo "<td>" . $row["ClientOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "</tr>";
    }
}

?>