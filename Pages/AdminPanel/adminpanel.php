<!DOCTYPE html>
<html>

<?php include("htmlHead.php") ?>

<body>
    <?php 
    if (isset($_POST["login"]) && isset($_POST["passwd"])) {
        require_once("connect.php"); // Подключение файла для связи с БД

        // // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);
        
        $login = $_POST["login"];
        $passwd = $_POST["passwd"];

        $sql = "SELECT 
                    idStaff id,
                    StaffSurname surname,
                    StaffName name,
                    StaffOtch otch,
                    Post,
                    Phone,
                    Mail,
                    Passwd
                FROM
                    Staff;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);

        // Проверим, есть ли записи в таблице
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if($row["name"] == $login && $row["passwd"] == $passwd) { ?>

    <?php include("Pages/AdminPanel/head.php"); ?>
    <h2 style="text-align: center;">Добро пожаловать в административную панель!</h2>
    <?php 
                } else {
                    header("Location: /openAdminPanel.php");
                }
            }
        } 
    } ?>
</body>

</html>