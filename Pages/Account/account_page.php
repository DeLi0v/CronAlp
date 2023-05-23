<!DOCTYPE html>
<html>

<head>
    <?php include("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="bron-selected">
    <?php     
    session_name("account");
    session_start();
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idClient"])) {
        $page = "account"; ?>
        <?php include("../../MainNavigation.php"); ?>
        <?php
        require_once("../../connect.php"); // Подключение файла для связи с БД

        // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);

        $id = $_SESSION['idClient'];

        $sql = "SELECT 
                    Services.idService id,
                    DATE_FORMAT(Services.ServiceData, '%d.%m.%Y %H:%i') date,
                    Clients.ClientSurname clientSurname,
                    Clients.ClientName clientName,
                    Clients.ClientOtch clientOtch,
                    Equepments.EquepmentName equepment,
                    ResortStatus.name resortName,
                    DATE_FORMAT(NOW(), '%d.%m.%Y %H:%i') now
                FROM 
                    Services
                    left join Clients on Clients.idClient = Services.idClient
                    left join Equepments on Equepments.idEquepment = Services.idEquepment
                    left join ResortStatus on ResortStatus.id = Services.idStatusEquepment
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
                <th style=\"width: 0;\">Дата</th>
                <th>Оборудование</th>
                <th style=\"width: 0;\">Статус</th>
                <th style=\"width: 0;\">Отменить</th>
            </tr>";

            // Выводим данные из таблицы
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class=\"center\">" . $row["date"] . "</td>";
                echo "<td>" . $row["equepment"] . "</td>";
                echo "<td>" . $row["resortName"] . "</td>";
                if ($row["date"] == $row["now"]) {
                    echo "<td class=\"center\">
                            <form action='/Pages/Booking/deleteBooking.php?id=\"".$row["id"]."\"' method=\"post\">
                                <input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
                                <input type=\"hidden\" name=\"page\" value=\"$page\">
                                <input type=\"image\" name=\"submit\" value=\"Delete\" src=\"/pictures/icons/remove.png\" style=\"max-width: 35px;border: 0;padding: 2px 0;padding-top: 4px;\">
                            </form>
                        </td>";
                } else {
                    echo "<td class=\"center\">
                              <img src=\"/pictures/icons/stop.png\" style=\"max-width: 35px;border: 0;\">
                          </td>";
                }
                echo "</tr>";
            }

            // Выводим конец таблицы
            echo "</table>";
            echo "</div>";
        } else {
            echo "<h3 style=\"text-align:center;\">На данный момент вы ничего не бронировали</h3>";
        }
        ?>
    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>