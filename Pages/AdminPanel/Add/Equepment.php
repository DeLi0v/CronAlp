<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="equepment-add">
    <?php 
    session_name("account");
    session_start();
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Добавление оборудования</h3>
    <form class="add" action="/Pages/AdminPanel/Add/EquepmentAdd.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Name">Наименование:</label>
                <input type="text" name="Name" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Size">Размер:</label>
                <input type="number" name="Size" required/>
            </li>
            <li class="form-row">
                <label for="Category">Категория:</label>
                <?php 
                    require_once("../../../connect.php"); // Подключение файла для связи с БД

                    // // Подключение к БД
                    $db = new DB_Class();
                    $conn = $db->connect();
                    mysqli_select_db($conn, $db->database);

                    // Формируем SQL-запрос для получения данных из таблицы "users"
                    $sql = "SELECT * FROM EquepmentCategories;";

                    // Выполняем SQL-запрос
                    $result = mysqli_query($conn, $sql);
                    
                    /*Выпадающий список*/
                    echo "<select name=\"Category\">";
                    
                    while($object = mysqli_fetch_object($result)){
                        echo "<option value = '$object->idEquepmentCategory' > $object->idEquepmentCategory - $object->CategoryName</option>";
                    }
                    
                    echo "</select>";
                ?>
            </li>
            <li class="form-row">
                <label for="Price">Цена (руб/ч):</label>
                <input type="text" name="Price" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Storage">Место хранения:</label>
                <input type="text" name="Storage" size="20px" required/>
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>

    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>