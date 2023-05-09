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
if (isset($_POST["Equepment"]) || isset($_POST["newSkiPass"]) || isset($_POST["skiPass"]) || isset($_POST["total"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    session_start();

    $data = 'NOW()';
    $staff = $_SESSION['staff'];
    $client = $_SESSION['client'];
    $operation = $_SESSION['operation'];
    if ($operation == "1" || $operation == "2") { // Выдача или прием оборудования
        $equepment = $conn->real_escape_string($_POST["Equepment"]);
        $newSkiPass = $_SESSION['newSkiPass'];
        $skiPass = $_SESSION['skiPass'];
        $total = $_SESSION['total'];    
    } elseif ($operation == "3") { // Оплата проката
        $equepment = $conn->real_escape_string($_POST["Equepment"]);
        $newSkiPass = $_SESSION['newSkiPass'];
        $skiPass = $_SESSION['skiPass'];
        $total = $conn->real_escape_string($_POST["total"]); 
    } elseif ($operation == "4") { // Пополнение ski-pass
        $equepment = $_SESSION['equepment'];
        $newSkiPass = $conn->real_escape_string($_POST["newSkiPass"]);
        $skiPass = $conn->real_escape_string($_POST["skiPass"]);
        $total = $conn->real_escape_string($_POST["total"]);
    }

    $sql = "INSERT INTO Services (ServiceData, idStaff, idClient, idOperation, idEquepment, NewSki_pass, idSki_pass, Total) 
                VALUES ($data,'$staff', '$client', '$operation', '$equepment', '$newSkiPass', '$skiPass', '$total');";
    if($conn->query($sql)){
        echo "<div align=\"center\">
        <img src=\"/pictures/icons/success.png\" style=\"max-height: 100px;max-width: 100px; padding-top: 15px;\">
        <div style=\"font-size: 20px;padding-top: 10px;\">Данные успешно добавлены</div>
    </div>";

    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Что-то не так";
}
?>
</body>
</html>