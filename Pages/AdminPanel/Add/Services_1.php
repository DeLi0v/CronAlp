<?php
include_once("../../../cookee.php");
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
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

    <?php include("../head.php"); ?>
    <?php 
        require_once("../../../connect.php"); // Подключение файла для связи с БД

        // // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);
    ?>

    <h3 style="text-align:center;">Добавление выполненной услуги</h3>
    <form class="add" action="/Pages/AdminPanel/Add/Services_2.php" method="post"  style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Staff">Сотрудник:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM Staff WHERE idStaff <> '1';";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Staff\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idStaff' >$object->StaffSurname $object->StaffName $object->StaffOtch</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="Client">Клиент:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM Clients";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Client\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idClient' >$object->ClientSurname $object->ClientName $object->ClientOtch</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="Operation">Вид услуги:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM OperationTypes WHERE idOperationType <> \"6\"";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Operation\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idOperationType' >$object->OperationName</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <button type="submit">Дальше</button>
            </li>
        </ul>
    </form>

    <?php $db->close(); } else { ?>
        <script>
            window.location.replace("/index.php")
        </script>
    <?php } ?>

</body>

</html>