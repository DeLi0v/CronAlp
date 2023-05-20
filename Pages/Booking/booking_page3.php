<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    session_name("account");
    session_start();
    $page = "booking" 
    ?>

    <?php include_once("../../MainNavigation.php") ?>
    
    <form class="add" action="/Pages/Booking/bronAdd.php" method="post" style=" margin:auto; width:500px;">
        <h3 style="text-align:center;">Бронирование оборудования</h3>
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Оборудование:</label>
                <?php 
                if (isset($_POST["id"]) && isset($_POST["Category"])) {
                    
                    require_once("../../connect.php"); // Подключение файла для связи с БД

                    // // Подключение к БД
                    $db = new DB_Class();
                    $conn = $db->connect();
                    mysqli_select_db($conn, $db->database);
                    
                    $id = $conn->real_escape_string($_POST["id"]);
                    $category = $conn->real_escape_string($_POST["Category"]);

                    // Формируем SQL-запрос
                    $sql = "SELECT 
                                Equepments.idEquepment idEquepment,
                                Equepments.EquepmentName EquepmentName,
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
                                            WHERE idOperation = 6
                                            GROUP BY idoperation, idEquepment) t 
                                            on Services.idEquepment = t.idEquepment and t.ServiceData > Services.ServiceData
                            WHERE 
                                ifnull(Services.idOperation,2) = 2
                                AND sec.idOperation IS NULL
                                AND t.idOperation IS NULL
                                AND Equepments.idCategory = \"$category\"
                            ORDER BY idEquepment;";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);

                    /*Выпадающий список*/
                    echo "<select name=\"Equepment\">";

                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idEquepment' >$object->EquepmentName</option>";
                    }

                    echo "</select>";

                    echo "<input type=\"hidden\" name=\"Client\" value=\"$id\">";
                } ?>
            </li>

            <li class="form-row" style="justify-content: space-between;">
                <a href="/Pages/Booking/booking_page2.php?id=<?php echo $id ?>">Назад</a>
                <button type="submit">Забронировать</button>
            </li>
        </ul>
    </form>
</body>

</html>