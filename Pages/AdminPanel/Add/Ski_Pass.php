<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="ski_pass-add">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Выдача ski-pass</h3>
    <form class="add" action="/Pages/AdminPanel/Add/Ski_PassAdd.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="ClientSurname">Клиент, которому выдается ski-pass:</label>
                <?php 
                    require_once("../../../connect.php"); // Подключение файла для связи с БД

                    // // Подключение к БД
                    $db = new DB_Class();
                    $conn = $db->connect();
                    mysqli_select_db($conn, $db->database);

                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM Clients";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Client\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idClient' > $object->idClient - $object->ClientSurname $object->ClientName $object->ClientOtch</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>
</body>

</html>