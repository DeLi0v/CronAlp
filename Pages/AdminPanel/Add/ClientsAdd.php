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
if (isset($_POST["Staff"]) && isset($_POST["Client"]) && isset($_POST["Operation"]) && isset($_POST["Equepment"]) && isset($_POST["newSkiPass"]) && isset($_POST["skiPass"]) && isset($_POST["total"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $data = date('l jS \of F Y h:i:s A');
    $staff = $conn->real_escape_string($_POST["Staff"]);
    $client = $conn->real_escape_string($_POST["Client"]);
    $operation = $conn->real_escape_string($_POST["Operation"]);
    $equepment = $conn->real_escape_string($_POST["Equepment"]);
    $newSkiPass = $conn->real_escape_string($_POST["newSkiPass"]);
    $skiPass = $conn->real_escape_string($_POST["skiPass"]);
    $total = $conn->real_escape_string($_POST["total"]);

    $sql = "INSERT INTO Services (ServiceData, idStaff, idClient, idOperation, idEquepment, NewSki_pass, idSki_pass, Total) VALUES ('$data','$staff', '$client', '$operation', '$equepment', '$newSkiPass', '$skiPass', '$total');";
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