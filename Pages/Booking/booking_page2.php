<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <!-- <link rel="stylesheet" href="/Styles/AdminPanelStyles.css"> -->
    <style>
        /*Стили для формы*/
        form.add {
            margin: auto;
            width: 500px;
        }

        h3 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        ul.wrapper {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        li.form-row {
            margin-top: 10px;
        }

        /*Стили для выпадающего списка*/
        select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
    <?php $page = "booking" ?>
    <?php include_once("../../MainNavigation.php") ?>
    <form class="add" action="/Pages/Booking/booking_page3.php" method="post" style=" margin:auto; width:500px;">
        <h3 style="text-align:center;">Бронирование оборудования</h3>
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Категория оборудования:</label>
                <?php
                if (isset($_POST["Surname"]) && isset($_POST["Name"]) && isset($_POST["Otch"]) && isset($_POST["Phone"]) && isset($_POST["Mail"]) && isset($_POST["Passwd"])) {
                    require_once("../../connect.php"); // Подключение файла для связи с БД

                    // // Подключение к БД
                    $db = new DB_Class();
                    $conn = $db->connect();
                    mysqli_select_db($conn, $db->database);

                    $surname = $conn->real_escape_string($_POST["Surname"]);
                    $name = $conn->real_escape_string($_POST["Name"]);
                    $otch = $conn->real_escape_string($_POST["Otch"]);
                    $phone = $conn->real_escape_string($_POST["Phone"]);
                    $mail = $conn->real_escape_string($_POST["Mail"]);
                    $passwd = $conn->real_escape_string($_POST["Passwd"]);

                    $sql = "SELECT * 
                            FROM Clients
                            WHERE
                                ClientSurname = \"$surname\"
                                AND ClientName = \"$name\"
                                AND ClientOtch = \"$otch\"
                                AND Phone = \"$phone\"";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 0) { // Если такого клиента в базе нет, то создаем запись о нем
                        $sql = "INSERT INTO Clients (ClientSurname, ClientName, ClientOtch, Phone, Mail, Passwd) VALUES ('$surname', '$name', '$otch', '$phone', '$mail', '$passwd');";
                        mysqli_query($conn, $sql);
                    }

                    // Получаем id клиента
                    $sql = "SELECT * 
                            FROM Clients
                            WHERE
                                ClientSurname = \"$surname\"
                                AND ClientName = \"$name\"
                                AND ClientOtch = \"$otch\"
                                AND Phone = \"$phone\"";
                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row["idClient"];
                        }
                    }

                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM EquepmentCategories";
                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);

                    /*Выпадающий список*/
                    echo "<select name=\"Category\">";

                    while ($object = mysqli_fetch_object($result)) {
                        echo "<option value = '$object->idEquepmentCategory'>$object->CategoryName</option>";
                    }

                    echo "</select>";

                    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">
                            <input type=\"hidden\" name=\"Surname\" value=\"$surname\">
                            <input type=\"hidden\" name=\"Name\" value=\"$name\">
                            <input type=\"hidden\" name=\"Otch\" value=\"$otch\">
                            <input type=\"hidden\" name=\"Phone\" value=\"$phone\">
                            <input type=\"hidden\" name=\"Mail\" value=\"$mail\">
                            <input type=\"hidden\" name=\"Passwd\" value=\"$passwd\">";
                ?>
            </li>

            <li class="form-row" style="justify-content: space-between;">
                <a href="/index.php">Назад</a>
                <button type="submit">Далее</button>
            </li>

        <?php } else {
                    echo "Ошибка";
                }
        ?>
        </ul>
    </form>
</body>

</html>