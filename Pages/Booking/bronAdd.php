<!DOCTYPE html>
<html>

<head>
    <title>Заказ подтвержден</title>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="services">
    <?php $page = "booking" ?>
    <?php include_once("../../MainNavigation.php") ?>
    <?php 
        if (isset($_POST["Client"]) && isset($_POST["Equepment"])) {
        
        require_once("../../connect.php"); // Подключение файла для связи с БД
        // Подключение к БД
        $db = new DB_Class();
        $conn = $db->connect();
        mysqli_select_db($conn, $db->database);
        
        $data = 'NOW()';
        $staff = 1; // система
        $operation = 6; // бронирование
        $newSkiPass = 0;
        $client = $conn->real_escape_string($_POST["Client"]);
        $equepment = $conn->real_escape_string($_POST["Equepment"]);

        $sql = "INSERT INTO Services (ServiceData, idStaff, idClient, idOperation, idEquepment, NewSki_pass, idSki_pass, Total) 
                VALUES ($data,'$staff', '$client', '$operation', '$equepment', Null, Null, Null);";

        if($conn->query($sql)) {
            echo "<div align=\"center\">
            <img src=\"/pictures/icons/success.png\" style=\"max-height: 100px;max-width: 100px; padding-top: 15px;\">
            <div style=\"font-size: 20px;padding-top: 10px;\">Оборудование успешно забронировано</div>";
            echo "</div>";
        } else{
            echo "Ошибка: " . $conn->error;
        }
    } ?>
</body>

</html> 