<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="clients-add">
    <?php include("../../../head.php"); ?>
    <?php 
        require_once("../../../connect.php"); // Подключение файла для связи с БД

        // // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);
    ?>

    <h3 style="text-align:center;">Добавление клиента</h3>
    <form action="/Pages/AdminPanel/Add/ClientsAdd.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Staff">Сотрудник:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM Staff";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Staff\" size=\"20px\">";
                    
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
                    echo "<select name=\"Client\" size=\"20px\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idClient' >$object->ClientSurname $object->ClientName $object->ClientOtch</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="Opearation">Вид услуги:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM OperationTypes";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Opearation\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idOperationType' >$object->OperationName</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="Equepment">Оборудование:</label>
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM Equepments";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Equepment\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idEquepment' >$object->idEquepment - $object->idCategory - $object->EquepmentName</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="newSkiPass">Новый ski-pass:</label>
                <input type="radio" name="newSkiPass" value="true"/>Да<br>
                <input type="radio" name="newSkiPass" value="false"/>Нет
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
                <label for="total">Новый ski-pass:</label>
                <input type="number" name="total">
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>
</body>

</html>