<?php
// Данные для подключения к базе данных
$hostname = "localhost";
$username = "root";
$password = "1";
$database = "mydb";

// Создаем подключение к базе данных
$conn = mysqli_connect($hostname, $username, $password, $database);

// Проверяем, удалось ли подключиться к базе данных
if (!$conn) {
    die("Подключение не удалось: " . mysqli_connect_error());
}

// Формируем SQL-запрос для получения данных из таблицы "users"
$sql = "SELECT * FROM Clients";

// Выполняем SQL-запрос
$result = mysqli_query($conn, $sql);

// Проверим, есть ли записи в таблице
if (mysqli_num_rows($result) > 0) {
    // Выводим начало таблицы
    echo "<table>";
    echo "<tr><th>ID</th><th>Фамилия</th>Имя<th></th><th>Отчество</th><th>Телефон</th><th>Почта</th><th>Пароль</th></tr>";

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

    // Выводим конец таблицы
    echo "</table>";
} else {
    echo "Нет данных в таблице.";
}

// Закрываем подключение к базе данных
mysqli_close($conn);
?>