<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="operations-add">
<?php include("../head.php"); ?>
<?php
if (isset($_POST["Name"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $name = $conn->real_escape_string($_POST["Name"]);

    $sql = "INSERT INTO OperationTypes (OperationName) VALUES ('$name');";
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