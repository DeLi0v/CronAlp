<?php

function SelectTable($table){
require_once("../../../connect.php"); // Подключение файла для связи с БД

// // Подключение к БД
$db = new DB_Class();
$conn = $db->connect();
mysqli_select_db($conn, $db->database);

// session_start();
// $_SESSION["conn"] = $conn;

// Формируем SQL-запрос
if($table == 'Ski_pass') {
    $sql = "SELECT 	
        Ski_pass.idSki_pass id,
        Clients.ClientSurname Surname,
        Clients.ClientName Name,
        Clients.ClientOtch Otch,
        Ski_pass.Balance Balance 
    FROM 
        Ski_pass
        join Clients on Clients.idClient = Ski_pass.idClient;";
} elseif($table == 'Equepments') {
    $sql = "SELECT 	
        Equepments.idEquepment id,
        Equepments.EquepmentName Name,
        EquepmentCategories.CategoryName Category
    FROM 
        Equepments
        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory;";
} elseif($table == 'Services') {
        $sql = "SELECT 
            Services.idService id,
            DATE_FORMAT(Services.ServiceData, '%d.%m.%Y %H:%i') data,
            Staff.StaffSurname staffSurname,
            Staff.StaffName staffName,
            Staff.StaffOtch staffOtch,
            Clients.ClientSurname clientSurname,
            Clients.ClientName clientName,
            Clients.ClientOtch clientOtch,
            OperationTypes.OperationName operation,
            Equepments.EquepmentName equepment,
            Services.NewSki_Pass NewSki_pass,
            Services.idSki_pass ski_pass,
            Services.Total total
        FROM 
            Services
                left join Clients on Clients.idClient = Services.idClient
                left join Staff on Staff.idStaff = Services.idStaff
                left join OperationTypes on OperationTypes.idOperationType = Services.idOperation
                left join Equepments on Equepments.idEquepment = Services.idEquepment;";
} else {
    $sql = "SELECT * FROM ". $table;
}

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
    } elseif($table == 'Ski_pass') {
        Ski_Pass($result);
    } elseif ($table == 'EquepmentCategories'){
        EquepmentCategories($result);
    } elseif ($table == 'OperationTypes'){
        OperationTypes($result);
    }

    // Выводим конец таблицы
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div class=\"error\">В таблице нет данных.</div>";
}

// Закрываем подключение к базе данных
// mysqli_close($conn);
}

// Вывод таблицы клиентов
function Clients($result){
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th style=\"width: 0;\">Телефон</th>
            <th style=\"width: 0;\">Почта</th>
            <th>Пароль</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["idClient"] . "</td>";
        echo "<td>" . $row["ClientSurname"] . "</td>";
        echo "<td>" . $row["ClientName"] . "</td>";
        echo "<td>" . $row["ClientOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "<td class=\"center\">Изменить</td>";
        echo "<td class=\"center\">Удалить</td>";
        echo "</tr>";
    }
}

// Вывод таблицы сотрудников
function Staff($result){
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th style=\"width: 0;\">Телефон</th>
            <th style=\"width: 0;\">Почта</th>
            <th>Должность</th>
            <th>Пароль</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["idStaff"] . "</td>";
        echo "<td>" . $row["StaffSurname"] . "</td>";
        echo "<td>" . $row["StaffName"] . "</td>";
        echo "<td>" . $row["StaffOtch"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Mail"] . "</td>";
        echo "<td>" . $row["Post"] . "</td>";
        echo "<td>" . $row["Passwd"] . "</td>";
        echo "<td class=\"center\">Изменить</td>";
        echo "<td class=\"center\">Удалить</td>";
        echo "</tr>";
    }    
}

// Вывод таблицы ски-пассов
function Ski_Pass($result){
    
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th>Фамилия клиента</th>
            <th>Имя клиента</th>
            <th>Отчество клиента</th>
            <th style=\"width: 0;\">Баланс, руб</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["id"] . "</td>";
        echo "<td>" . $row["Surname"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["Otch"] . "</td>";
        echo "<td>" . $row["Balance"] . "</td>";
        echo "<td class=\"center\">Изменить</td>";
        echo "<td class=\"center\">Удалить</td>";
        echo "</tr>";
    }
}

// Вывод таблицы категорий оборудования
function EquepmentCategories($result){
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th>Наименование</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["idEquepmentCategory"] . "</td>";
        echo "<td>" . $row["CategoryName"] . "</td>";
        echo "<td class=\"center\">Изменить</td>";
        echo "<td class=\"center\">Удалить</td>";
        echo "</tr>";
    }
}

// Вывод таблицы оборудования
function Equepments($result){
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th>Наименование</th>
            <th>Категория</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["id"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["Category"] . "</td>";
        echo "<td class=\"center\"><button type=\"submit\" formaction=\"/Pages/AdminPanel/Edit.php\" formmethod=\"POST\" value=\"".$row["id"]."\" name=\"Equepment\">Изменить</button></td>";
        echo "<td class=\"center\">
                <form action='/Pages/AdminPanel/Delete.php?id=\"".$row["id"]."\"' method=\"post\">
                    <input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
                    <input type=\"hidden\" name=\"page\" value=\"Equepment\">
                    <input type=\"image\" name=\"submit\" value=\"Delete\" src=\"/pictures/icons/trash.png\" style=\"max-width: 35px;\">
                </form>
              </td>";
        echo "</tr>";
    }
}

// Вывод таблицы видов оказания услуг
function OperationTypes($result){
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th>Наименование</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["idOperationType"] . "</td>";
        echo "<td>" . $row["OperationName"] . "</td>";
        echo "<td class=\"center\">Изменить</td>";
        echo "<td class=\"center\">Удалить</td>";
        echo "</tr>";
    }
}

// Вывод таблицы услуг
function Services($result){
    echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th style=\"width: 0;\">Дата</th>
            <th>Сотрудник</th>
            <th>Клиент</th>
            <th style=\"width: 0;\">Операция</th>
            <th>Оборудование</th>
            <th style=\"width: 90px;\">Новый ski-pass?</th>
            <th style=\"width: 0;\">ID ski-pass</th>
            <th style=\"width: 0;\">Сумма</th>
            <th style=\"width: 0;\">Изменить</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

    // Выводим данные из таблицы
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class=\"center\">" . $row["id"] . "</td>";
        echo "<td class=\"center\">" . $row["data"] . "</td>";
        echo "<td>" . $row["staffSurname"] ." ". $row["staffName"] ." ". $row["staffOtch"] . "</td>";
        echo "<td>" . $row["clientSurname"] ." ". $row["clientName"] ." ". $row["clientOtch"] . "</td>";
        echo "<td>" . $row["operation"] . "</td>";
        echo "<td>" . $row["equepment"] . "</td>";
        echo "<td class=\"center\">" . $row["NewSki_pass"] . "</td>";
        echo "<td class=\"center\">" . $row["ski_pass"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
        echo "<td class=\"center\">Изменить</td>";
        echo "<td class=\"center\">Удалить</td>";
        echo "</tr>";
    }
}

?>