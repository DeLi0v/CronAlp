<!DOCTYPE html>
<html>

<head>
    <?php include("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="bron-selected">
    <?php $page = "account"; ?>
    <?php include("../../MainNavigation.php"); ?>
    <?php
    require_once("../../connect.php"); // Подключение файла для связи с БД

    // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    session_name("account");
    session_start();

    $id = $_SESSION['idClient'];

    $sql = "SELECT 
                Services.idService id,
                DATE_FORMAT(Services.ServiceData, '%d.%m.%Y %H:%i') data,
                Clients.ClientSurname clientSurname,
                Clients.ClientName clientName,
                Clients.ClientOtch clientOtch,
                Equepments.EquepmentName equepment
            FROM 
                Services
                left join Clients on Clients.idClient = Services.idClient
                left join Equepments on Equepments.idEquepment = Services.idEquepment
            WHERE
                Services.idOperation = \"6\"
                AND Services.idClient = '$id';";

    // Выполняем SQL-запрос
    $result = mysqli_query($conn, $sql);

    // Проверим, есть ли записи в таблице
    if (mysqli_num_rows($result) > 0) {
        echo "<h3 style=\"text-align:center;\">Список брони</h3>";

        // Выводим начало таблицы
        echo "<div>";
        echo "<table>";

        // Выводим первую строку
        echo "<tr>
            <th style=\"width: 0;\">ID</th>
            <th style=\"width: 0;\">Дата</th>
            <th>Клиент</th>
            <th>Оборудование</th>
            <th style=\"width: 0;\">Удалить</th>
        </tr>";

        // Выводим данные из таблицы
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class=\"center\">" . $row["id"] . "</td>";
            echo "<td class=\"center\">" . $row["data"] . "</td>";
            echo "<td>" . $row["clientSurname"] . " " . $row["clientName"] . " " . $row["clientOtch"] . "</td>";
            echo "<td>" . $row["equepment"] . "</td>";
            include("EditAndDeleteRows.php");
            echo "</tr>";
        }

        // Выводим конец таблицы
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div style=\"text-align:center;\">На данный момент вы ничего не бронировали</div>";
    }
    ?>
</body>

</html>