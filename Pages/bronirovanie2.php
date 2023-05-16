<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <div class="head">
        <a href="/index.php" style="text-decoration: none;"><h1>Горнолыжный курорт "Альпийская крона"</h1></a>
    </div>
    <form class="add" action="/Pages/bronAdd.php" method="post" style=" margin:auto; width:500px;">
        <h3 style="text-align:center;">Бронирование оборудования</h3>
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Оборудование:</label>
                <?php 
                if (isset($_POST["Surname"]) && isset($_POST["Name"]) && isset($_POST["Otch"]) && isset($_POST["Phone"]) && isset($_POST["Mail"]) 
                    && isset($_POST["Passwd"]) && isset($_POST["id"]) && isset($_POST["Category"])) {
                    
                    require_once("../connect.php"); // Подключение файла для связи с БД

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
                                            WHERE idOperation = 1
                                            GROUP BY idoperation, idEquepment) sec 
                                            on Services.idEquepment = sec.idEquepment and sec.ServiceData > Services.ServiceData
                            WHERE 
                                ifnull(Services.idOperation,2) = 2
                                AND sec.idOperation IS NULL
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
                <a href="/index.php">Назад</a>
                <button type="submit">Забронировать</button>
            </li>
        </ul>
    </form>
</body>

</html>