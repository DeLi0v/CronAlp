<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="services-add">
    <?php include("../../../head.php"); ?>
    <?php 
        require_once("../../../connect.php"); // Подключение файла для связи с БД

        // // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);
    ?>

    <h3 style="text-align:center;">Добавление выполненной услуги</h3>
    <?php 
    if (isset($_POST["Staff"]) && isset($_POST["Client"]) && isset($_POST["Operation"])) {

        echo "<form action=\"/Pages/AdminPanel/Add/ServicesAdd.php\" method=\"post\">
                <ul class=\"wrapper\">";

        $staff = $conn->real_escape_string($_POST["Staff"]);
        $client = $conn->real_escape_string($_POST["Client"]);
        $operation = $conn->real_escape_string($_POST["Operation"]);

        session_start(); 
        $_SESSION['staff'] = $staff;
        $_SESSION['client'] = $client;
        $_SESSION['operation'] = $operation;

        $sql = "SELECT 
                    Staff.StaffSurname staffSurname,
                    Staff.StaffName staffName,
                    Staff.StaffOtch staffOtch,
                    Clients.ClientSurname clientSurname,
                    Clients.ClientName clientName,
                    Clients.ClientOtch clientOtch,
                    OperationTypes.OperationName operation
                FROM 
                    OperationTypes
                    join Clients on Clients.idClient = \"$client\"
                    join Staff on Staff.idStaff = \"$staff\"
                WHERE
                    OperationTypes.idOperationType = \"$operation\";";
        
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);

        // Проверим, есть ли записи в таблице
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>Сотрудник: ". $row["staffSurname"] ." ". $row["staffName"] ." ". $row["staffOtch"] ." ". "</div>";
                echo "<div>Клиент: ". $row["clientSurname"] ." ". $row["clientName"] ." ". $row["clientOtch"] ." ". "</div>";
                echo "<div>Вид операции: ". $row["operation"] . "</div>";
            }
        } else {
            echo "<div class=\"error\">ОШИБКА.</div>";
        }

        if ($operation == "1") { // Выдача оборудования
            
            echo "<li class=\"form-row\">
                    <label for=\"Equepment\">Оборудование:</label>";  
            
            // Формируем SQL-запрос
            $sql = "SELECT 
                        Services.idService id,
                        Services.ServiceData data,
                        Services.idStaff staff,
                        Services.idClient client,
                        Services.idOperation operation,
                        Equepments.idEquepment idEquepment,
                        Equepments.EquepmentName EquepmentName,
                        EquepmentCategories.CategoryName Category
                    FROM 
                        Equepments 
                        join Services on Services.ServiceData > (select sv.ServiceData from Services sv where sv.idOperation =\"2\") and Services.idEquepment = Equepments.idEquepment 
                        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
                    WHERE
                        DAYOFMONTH(Services.ServiceData) = DAYOFMONTH(NOW()) -- вывод данных только на текущий день
                        AND MONTH(Services.ServiceData) = MONTH(NOW()) -- вывод данных только на текущий месяц
                        AND YEAR(Services.ServiceData) = YEAR(NOW());"; // вывод данных только на текущий год;

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->idCategory - $object->EquepmentName</option>";
            }

            echo "</select>
                </li>";
            
        } elseif($operation == "2") { // Прием оборудования
            
            echo "<li class=\"form-row\">
                    <label for=\"Equepment\">Оборудование:</label>";
            
            // Формируем SQL-запрос
            $sql = "SELECT 
                        Equepments.idEquepment idEquepment,
                        Equepments.EquepmentName EquepmentName,
                        EquepmentCategories.CategoryName Category
                    FROM 
                        Services
                        join Equepments on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
                    WHERE 
                        Services.idClient = \"$client\"
                        AND Services.idEquepment IS not NULL
                        AND Services.ServiceData > (select sv.ServiceData from Services sv where sv.idOperation =\"2\" and sv.idEquepment = \"Services.idEquepment\"))"; // вывод если ранее оборудование уже было принято 

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->Category - $object->EquepmentName</option>";
            }

            echo "</select>
                </li>";
            
            $_SESSION['newSkiPass'] = 'None';
            $_SESSION['skiPass'] = 'None';
            $_SESSION['total'] = 'None';

        } elseif ($operation == "3") { // Оплата проката

            echo "<li class=\"form-row\">
                    <label for=\"Equepment\">Оборудование:</label>";  
            
            // Формируем SQL-запрос для получения данных из таблицы "users"
            $sql = "SELECT 
                        Services.idService id,
                        Services.ServiceData data,
                        Equepments.EquepmentName
                    FROM 
                        Services
                        join Equepments on Equepments.idEquepment = Services.idEquepment
                    WHERE
                        DAYOFMONTH(Services.ServiceData) = DAYOFMONTH(NOW()) -- вывод данных на текущий день
                        AND MONTH(Services.ServiceData) = MONTH(NOW()) -- вывод данных на текущий месяц 
                        AND YEAR(Services.ServiceData) = YEAR(NOW()) -- вывод данных на текущий год
                        AND Services.idClient = \"$client\" -- вывод данных только по выбранному клиенту
                        AND Services.idOperation = \"2\""; // оплата возможна только если оборудование было сдано

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->idCategory - $object->EquepmentName</option>";
            }

            echo "</select>
                </li>";

        } elseif ($operation == "4") { // Пополнение ski-pass

        }

        echo "<li class=\"form-row\">
                <a href=\"/Pages/AdminPanel/Add/Services_1.php\">Назад</a>
                <button type=\"submit\">Добавить</button>
              </li>"; 
    } else {
        echo "Что-то не так";
    }
    ?>

            <!-- <li class="form-row">
                <label for="newSkiPass" style="flex: max-content;">Новый ski-pass:</label>
                <input type="radio" name="newSkiPass" value="1" id="radio-1"/>
                <label for="radio-1">Да</label>
                <input type="radio" name="newSkiPass" value="0" id="radio-2" selected/>
                <label for="radio-2">Нет</label>
            </li>
            <li class="form-row">
                <label for="skiPass">Ski-pass:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM Ski_pass";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"skiPass\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idSki_pass' >$object->idClient - $object->idSki_pass</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="total">Сумма:</label>
                <input type="number" name="total">
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form> -->
</body>

</html>