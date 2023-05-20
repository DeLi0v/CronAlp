<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
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
                require_once("../../connect.php"); // Подключение файла для связи с БД
                // Подключение к БД
                $db = new DB_Class();
                $conn = $db->connect();
                mysqli_select_db($conn, $db->database);

                session_name("account");
                session_start();
                
                if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idClient"])) {
                    $id = $_SESSION["idClient"];
                } elseif (isset($_POST["Surname"]) && isset($_POST["Name"]) && isset($_POST["Otch"]) 
                            && isset($_POST["Phone"]) && isset($_POST["Mail"]) && isset($_POST["Passwd"])) {

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
                    } elseif (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row["idClient"];
                        }
                    } 
                } else {
                    echo "Ошибка";
                }

                // Формируем SQL-запрос
                $sql = "SELECT * FROM EquepmentCategories";
                
                // Выполняем SQL-запрос
                $result = mysqli_query($conn, $sql);

                /*Выпадающий список*/
                echo "<select name=\"Category\">";

                if (mysqli_num_rows($result) > 0) {
                    while ($object = mysqli_fetch_object($result)) {
                        echo "<option value = '$object->idEquepmentCategory'>$object->CategoryName</option>";
                    }
                }

                echo "</select>";
                echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
                ?>

            </li>

            <li class="form-row" style="justify-content: space-between;">
                <a href="/index.php" class="back">Назад</a>
                <button type="submit">Далее</button>
            </li>

        </ul>
    </form>

</body>

</html>