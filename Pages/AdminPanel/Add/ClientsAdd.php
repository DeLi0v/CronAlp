<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="client-add">
<?php include("../head.php"); ?>
<?php
if (isset($_POST["Surname"]) && isset($_POST["Name"]) && isset($_POST["Otch"]) && isset($_POST["Phone"]) && isset($_POST["Mail"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $surname = $conn->real_escape_string($_POST["Surname"]);
    $name = $conn->real_escape_string($_POST["Name"]);
    $otch = $conn->real_escape_string($_POST["Otch"]);
    $phone = $conn->real_escape_string($_POST["Phone"]);
    $mail = $conn->real_escape_string($_POST["Mail"]);

    $sql = "INSERT INTO Clients (ClientSurname, ClientName, ClientOtch, Phone, Mail, Passwd) VALUES ('$surname', '$name', '$otch', '$phone', '$mail', Null);";
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