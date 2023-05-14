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

        echo "<form class=\"add\" action=\"/Pages/AdminPanel/Add/ServicesAdd.php\" method=\"post\">
                <ul class=\"wrapper\">";

        $staff = $conn->real_escape_string($_POST["Staff"]);
        $client = $conn->real_escape_string($_POST["Client"]);
        $operation = $conn->real_escape_string($_POST["Operation"]);

        session_start(); 
        $_SESSION['staff'] = $staff;
        $_SESSION['client'] = $client;
        $_SESSION['operation'] = $operation;
        $_SESSION['newSkiPass'] = 0;

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
                        Equepments.idEquepment idEquepment,
                        Equepments.EquepmentName EquepmentName,
                        EquepmentCategories.CategoryName Category
                    FROM 
                        Equepments
                        left join Services on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on Equepments.idCategory = EquepmentCategories.idEquepmentCategory
                    where
                        ifnull(Services.ServiceData, now()) >= 
                            (select ServiceData from Services where idOperation=\"2\" order by ServiceData desc limit 1)
                        OR ifnull(Services.ServiceData, now()) > 
                            (select ServiceData from Services where idOperation=\"1\" order by ServiceData desc limit 1)
                        AND ifnull(Services.idOperation,'1') < '3';";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->Category - $object->EquepmentName</option>";
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
                        EquepmentCategories.CategoryName Category,
                        Services.ServiceData,
                        Services.idClient
                    FROM 
                        Services
                        join Equepments on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
                    WHERE 
                        Services.idClient = \"$client\"
                        AND Services.idEquepment IS not NULL
                        AND Services.ServiceData > (select IFNULL(MAX(ServiceData), '2000-01-01 00:00:00')
                                                    from Services 
                                                    where idOperation =\"2\" and idClient=\"$client\")
                        AND ifnull(Services.idOperation,'1') < '3';"; // вывод если ранее оборудование уже было принято 

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->Category - $object->EquepmentName</option>";
            }

            echo "</select>
                </li>";

        } elseif ($operation == "3") { // Оплата проката

            echo "<li class=\"form-row\">
                    <label for=\"Equepment\">Оборудование:</label>";  
            
            // Формируем SQL-запрос
            $sql = "SELECT 
                        Services.idService endId,
                        Services.ServiceData endData,
                        Equepments.idEquepment idEquepment,
                        Equepments.EquepmentName EquepmentName,
                        begindata.startdata startData,
                        begindata.id startId,
                        EquepmentCategories.CategoryName Category
                    FROM 
                        Services
                        join Equepments on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on Equepments.idCategory = EquepmentCategories.idEquepmentCategory
                        join (Select 
                                Services.idService id,
                                Services.ServiceData startdata
                            from Services
                            where 
                                DAYOFMONTH(Services.ServiceData) = DAYOFMONTH(NOW())
                                AND MONTH(Services.ServiceData) = MONTH(NOW()) 
                                AND YEAR(Services.ServiceData) = YEAR(NOW())
                                AND Services.idClient = \"$client\"
                                AND Services.idOperation = \"1\"
                            ORDER BY ServiceData desc
                            limit 1) begindata
                    WHERE
                        DAYOFMONTH(Services.ServiceData) = DAYOFMONTH(NOW())
                        AND MONTH(Services.ServiceData) = MONTH(NOW()) 
                        AND YEAR(Services.ServiceData) = YEAR(NOW())
                        AND Services.idClient = \"$client\"
                        AND Services.idOperation = \"2\"
                        AND Services.ServiceData > (select ifnull(ServiceData,'2000-01-01 00:00:00') from Services where DAYOFMONTH(Services.ServiceData) = DAYOFMONTH(NOW())
                                                    AND MONTH(Services.ServiceData) = MONTH(NOW())
                                                    AND YEAR(Services.ServiceData) = YEAR(NOW())
                                                    AND idClient = \"$client\"
                                                    AND Services.idOperation = \"3\"
                                                    ORDER BY ServiceData desc
                                                    limit 1) 
                    ORDER BY ServiceData desc
                    limit 1;"; // оплата возможна только если оборудование было сдано

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->Category - $object->EquepmentName</option>";
            }

            echo "</select>
                </li>";
            
            echo "<li class=\"form-row\">
                    <label for=\"total\">Сумма:</label>
                    <input type=\"number\" name=\"total\"/>
                  </li>";

        } elseif ($operation == "4") { // Пополнение ski-pass
            
            echo "<li class=\"form-row\">
                    <label for=\"Equepment\">Ski-pass:</label>";  

            // Формируем SQL-запрос
            $sql = "SELECT 
                      Ski_pass.idSki_pass,
                      Ski_pass.Balance,
                      Clients.ClientSurname,
                      Clients.ClientName,  
                      Clients.ClientOtch
                    FROM 
                        Ski_pass 
                        join Clients on Ski_pass.idClient = Clients.idClient
                    WHERE Clients.idClient=\"$client\";";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
                while($object = mysqli_fetch_object($result)){
                    echo "<div>$object->idSki_pass</div>";
                    $_SESSION['idSki_pass'] = $object->idSki_pass;
                    $_SESSION['newSkiPass'] = 0;
                };
            } else{
                echo "<div>У данного клиента нет ski-pass</div>";
                $_SESSION['idSki_pass'] = 'New';
                $_SESSION['newSkiPass'] = 1;
            };
            
            echo "</li>";

            echo "<li class=\"form-row\">
                    <label for=\"total\">Сумма:</label>
                    <input type=\"number\" name=\"total\"/>
                  </li>";

        }

        echo "<li class=\"form-row\">
                <a href=\"/Pages/AdminPanel/Add/Services_1.php\">Назад</a>
                <button type=\"submit\">Добавить</button>
              </li>"; 
    } else {
        echo "Что-то не так";
    }
    ?>
</body>

</html>