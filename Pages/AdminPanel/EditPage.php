<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php include("../../head.php"); ?>
    <form class="add" action="/Pages/AdminPanel/Edit.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">

<?php if (isset($_POST["id"]) && isset($_POST["page"])) {
    
    // Подключение файла для связи с БД
    require_once("../../connect.php"); 

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $id = $_POST["id"];
    $page = $_POST["page"];
    $error = 0;

    if ($page == "Clients") {
        // Запрос
        $sql = "SELECT * FROM Clients WHERE idClient = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $surname =  $row["ClientSurname"];
                $name =  $row["ClientName"];
                $otch =  $row["ClientOtch"];
                $phone =  $row["Phone"];
                $mail =  $row["Mail"];
                $passwd =  $row["Passwd"];
            }
        }
?>
    <h3 style="text-align:center;">Изменение данных о клиенте</h3>
    <li class="form-row">
        <label for="Surname">Фамилия:</label>
        <input type="text" name="Surname" size="20px" value="<?php echo $surname?>"/>
    </li>
    <li class="form-row">
        <label for="Name">Имя:</label>
            <input type="text" name="Name" size="20px" value="<?php echo $name?>"/>
    </li>
    <li class="form-row">
        <label for="Otch">Отчетсво:</label>
        <input type="text" name="Otch" size="20px" value="<?php echo $otch?>"/>
    </li>
    <li class="form-row">
        <label for="Phone">Телефон:</label>
        <input type="tel" name="Phone" size="20px" value="<?php echo $phone?>"/>
    </li>
    <li class="form-row">
        <label for="Mail">Почта:</label>
        <input type="email" name="Mail" size="20px" value="<?php echo $mail?>"/>
    </li>
    <li class="form-row">
        <label for="Passwd">Пароль:</label>
        <input type="text" name="Passwd" size="20px" value="<?php echo $passwd?>"/>
    </li>
<?php
    } elseif ($page == "Ski_Pass") {
        // Запрос
        $sql = "SELECT * FROM Ski_pass WHERE idSki_pass = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $balance =  $row["Balance"];
            }
        }
?>

<h3 style="text-align:center;">Изменение баланса ski-pass</h3>
            <li class="form-row">
                <label for="Balance">Баланс:</label>
                <input type="text" name="Balance" size="20px" value="<?php echo $balance?>"/>
            </li>

<?php } elseif ($page == "Staff") {
        // Запрос
        $sql = "SELECT * FROM Staff WHERE idStaff = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $surname =  $row["StaffSurname"];
                $name =  $row["StaffName"];
                $otch =  $row["StaffOtch"];
                $phone =  $row["Phone"];
                $mail =  $row["Mail"];
                $passwd =  $row["Passwd"];
                $post = $row["Post"];
            }
        }
?>
    <h3 style="text-align:center;">Изменение данных о сотруднике</h3>
            <li class="form-row">
                <label for="Surname">Фамилия:</label>
                <input type="text" name="Surname" size="20px" value="<?php echo $surname?>"/>
            </li>
            <li class="form-row">
                <label for="Name">Имя:</label>
                <input type="text" name="Name" size="20px" value="<?php echo $name?>"/>
            </li>
            <li class="form-row">
                <label for="Otch">Отчетсво:</label>
                <input type="text" name="Otch" size="20px" value="<?php echo $otch?>"/>
            </li>
            <li class="form-row">
                <label for="Post">Должность:</label>
                <input type="text" name="Post" size="20px" value="<?php echo $post?>"/>
            </li>
            <li class="form-row">
                <label for="Phone">Телефон:</label>
                <input type="tel" name="Phone" size="20px" value="<?php echo $phone?>"/>
            </li>
            <li class="form-row">
                <label for="Mail">Почта:</label>
                <input type="email" name="Mail" size="20px" value="<?php echo $mail?>"/>
            </li>
            <li class="form-row">
                <label for="Passwd">Пароль:</label>
                <input type="text" name="Passwd" size="20px" value="<?php echo $passwd?>"/>
            </li>

<?php } elseif ($page == "Equepment") {
        // Запрос
        $sql = "SELECT * FROM Equepments LEFT JOIN EquepmentCategories on Equepments.idCategory = EquepmentCategories.idEquepmentCategory WHERE idEquepment = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name =  $row["EquepmentName"];
                $idCategory = $row["idCategory"];
                $nameCategory = $row["CategoryName"];
            }
        } ?>

<h3 style="text-align:center;">Изменение данных об оборудовании</h3>
            <li class="form-row">
                <label for="Name">Наименование:</label>
                <input type="text" name="Name" size="20px" value="<?php echo $name?>"/>
            </li>
            <li class="form-row">
                <label for="Category">Категория:</label>
                <!-- <input type="text" name="Category" size="20px" value="<?php echo $category?>"/> -->
                <?php 
                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM EquepmentCategories WHERE idEquepmentCategory = $idCategory;";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Category\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idEquepmentCategory' > $object->idEquepmentCategory - $object->CategoryName</option>";
                    }

                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM EquepmentCategories WHERE idEquepmentCategory <> $idCategory;";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idEquepmentCategory' > $object->idEquepmentCategory - $object->CategoryName</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>

<?php } elseif ($page == "EquepmentCategories") {
        // Запрос
        $sql = "SELECT * FROM EquepmentCategories WHERE idEquepmentCategory = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name =  $row["CategoryName"];
            }
        } ?>

<h3 style="text-align:center;">Изменение наименования категории оборудования</h3>
            <li class="form-row">
                <label for="Name">Наименование:</label>
                <input type="text" name="Name" size="20px" value="<?php echo $name?>"/>
            </li>

<?php } elseif ($page == "OperationTypes") {
        // Запрос
        $sql = "SELECT * FROM OperationTypes WHERE idOperationType = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name =  $row["OperationName"];
            }
        } ?>

<h3 style="text-align:center;">Изменение наименования вида услуги</h3>
            <li class="form-row">
                <label for="Name">Наименование:</label>
                <input type="text" name="Name" size="20px" value="<?php echo $name?>"/>
            </li>

<?php } elseif ($page == "Services") {
        // Запрос
        $sql = "SELECT * FROM Services WHERE idService = $id AND idOperation IN(3,4);";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $total =  $row["Total"];
            }
        ?>

<h3 style="text-align:center;">Изменение стоимости услуги</h3>
            <li class="form-row">
                <label for="Total">Стоимость:</label>
                <input type="text" name="Total" size="20px" value="<?php echo $total?>"/>
            </li>

<?php } else {echo "<div class=\"error\">Данная услуга не связана с оплатой</div>"; $error = 1; } } ?>
            
                <li class="form-row">
                    <a href="/Pages/AdminPanel/Select/<?php echo $page?>.php">Назад</a>
                    <?php if($error == 0) {
                        echo "<input type=\"hidden\" name=\"id\" value=\"$id\">
                            <input type=\"hidden\" name=\"page\" value=\"$page\">";
                    ?>
                    <button type="submit">Изменить</button>
                    <?php } ?>
                </li>
        </ul>
    </form>
</body>

<?php 
} else {
    echo "Что-то не так";
}
?>

</html>
