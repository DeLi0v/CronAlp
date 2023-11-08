<?php
include_once("../../cookee.php");
startmysession(0, "/", "localhost", true, false);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="services-add">
    <?php 
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { 
        session_write_close(); ?>

    <?php include("../head.php"); ?>
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

        echo "<form class=\"add\" action=\"/Pages/AdminPanel/Add/ServicesAdd.php\" method=\"post\"  style=\"margin:auto; width:500px;\">
                <ul class=\"wrapper\">";

        $staff = $conn->real_escape_string($_POST["Staff"]);
        $client = $conn->real_escape_string($_POST["Client"]);
        $operation = $conn->real_escape_string($_POST["Operation"]);

        session_name("addServices");
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
                        Equepments.size,
                        EquepmentCategories.CategoryName Category,
                        ifnull(Services.ServiceData,NOW()) ServiceData,
                        ifnull(Services.idOperation,2) idOperation,
                        sec.idOperation secOp
                    FROM 
                        Services
                        RIGHT join Equepments on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
                        left join (SELECT idoperation, idEquepment, MAX(ServiceData) ServiceData 
                                    FROM Services 
                                    WHERE idOperation in(1,7)
                                    GROUP BY idoperation, idEquepment) sec 
                                    on Services.idEquepment = sec.idEquepment and sec.ServiceData > Services.ServiceData
                        left join (SELECT idoperation, idEquepment, MAX(ServiceData) ServiceData 
                                    FROM Services 
                                    WHERE idOperation = 6 AND idStatusEquepment  NOT IN (5)
                                    GROUP BY idoperation, idEquepment) t 
                                    on Services.idEquepment = t.idEquepment and t.ServiceData > Services.ServiceData
                    WHERE 
                        (ifnull(Services.idOperation,2) = 2 OR (ifnull(Services.idOperation,6) = 6 AND Services.idStatusEquepment = 6))
                        AND sec.idOperation IS NULL
                        AND t.idOperation IS NULL
                    ORDER BY idEquepment;";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->Category - $object->EquepmentName - $object->size р.</option>";
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
                        Services.idClient,
                        Services.idOperation,
                        sec.idOperation secOp
                    FROM 
                        Services
                        join Equepments on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
                        left join (SELECT idoperation, idEquepment, ServiceData 
                                    FROM Services 
                                    WHERE idClient = \"$client\" AND idEquepment IS not NULL AND idOperation = 2) sec 
                                    on Services.idEquepment = sec.idEquepment and sec.ServiceData > Services.ServiceData
                    WHERE 
                        Services.idClient = \"$client\"
                        AND Services.idEquepment IS not NULL
                        AND Services.idOperation IN(1,7)
                        AND sec.idOperation IS NULL;"; // вывод если ранее оборудование уже было принято 

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
            Equepments.idEquepment idEquepment,
            Equepments.EquepmentName EquepmentName,
            Equepments.size size,
            Equepments.price price,
            EquepmentCategories.CategoryName Category,
            Services.ServiceData,
            Services.idClient,
            Services.idOperation,
            sec.idOperation secOp
        FROM 
            Services
            join Equepments on Equepments.idEquepment = Services.idEquepment
            join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
            left join (SELECT idoperation, idEquepment, ServiceData 
                        FROM Services 
                        WHERE idClient = \"$client\" AND idEquepment IS not NULL AND idOperation in(2,3)) sec 
                        on Services.idEquepment = sec.idEquepment and sec.ServiceData > Services.ServiceData
        WHERE 
            Services.idClient = \"$client\"
            AND Services.idEquepment IS not NULL
            AND Services.idOperation = 2
            AND sec.idOperation IS NULL";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->Category - $object->EquepmentName - $object->size р. - $object->price руб./ч.</option>";
            }

            echo "</select>
                </li>";
            
            echo "<li class=\"form-row\">
                    <label for=\"total\">Сумма:</label>
                    <input type=\"number\" name=\"total\" required/>
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
                    <input type=\"number\" name=\"total\" required/>
                  </li>";

        } elseif ($operation == "7") { // Выдача брони
            
            echo "<li class=\"form-row\">
                    <label for=\"Equepment\">Оборудование:</label>";  
            
            // Формируем SQL-запрос
            $sql = "SELECT 
                        Services.idService id,
                        Equepments.idEquepment idEquepment,
                        Equepments.EquepmentName EquepmentName,
                        EquepmentCategories.CategoryName Category,
                        ifnull(Services.ServiceData,NOW()) ServiceData
                    FROM 
                        Services
                        RIGHT join Equepments on Equepments.idEquepment = Services.idEquepment
                        join EquepmentCategories on EquepmentCategories.idEquepmentCategory = Equepments.idCategory
                    WHERE 
                        Services.idOperation = '6'
                        AND Services.idStatusEquepment NOT IN (4,5,6)
                        AND Services.idClient = '$client'
                    ORDER BY idEquepment;";

            // Выполняем SQL-запрос
            $result = mysqli_query($conn, $sql);
            
            /*Выпадающий список*/
            echo "<select name=\"Equepment\">";
            
            while($object = mysqli_fetch_object($result)){
                echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->Category - $object->EquepmentName - $object->size р.</option>";
            }

            echo "</select>
                </li>";
        }

        echo "<li class=\"form-row\" style=\"justify-content: space-between;\">
                <a href=\"/Pages/AdminPanel/Add/Services_1.php\">Назад</a>
                <button type=\"submit\">Добавить</button>
              </li>"; 
    } else {
        echo "Что-то не так";
    }
    ?>
    
    <?php $db->close(); } else { header("Location: /index.php"); } ?>
</body>

</html>