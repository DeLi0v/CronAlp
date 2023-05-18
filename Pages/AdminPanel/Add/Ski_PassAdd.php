<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="ski_pass-add">
<?php include("../head.php"); ?>
<?php
if (isset($_POST["Client"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $idClient = $conn->real_escape_string($_POST["Client"]);
    
    $sql = "SELECT *
            FROM Ski_pass
            WHERE Ski_pass.idClient = \"$idClient\";";
    
    // Выполняем SQL-запрос
    $result = mysqli_query($conn, $sql);

    // Проверим, есть ли записи в таблице
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO Ski_pass (idClient, Balance) VALUES ('$idClient', '0');";
        if($conn->query($sql)){
            echo "<div align=\"center\">
                <img src=\"/pictures/icons/success.png\" style=\"max-height: 100px;max-width: 100px; padding-top: 15px;\">
                <div style=\"font-size: 20px;padding-top: 10px;\">Данные успешно добавлены</div>
            </div>";
        } else{
            echo "Ошибка: " . $conn->error;
        }
    } else {
        echo "<div class=\"error\">У данного клиента уже есть ski-pass</div>";
    }
    $conn->close();
} else {
    echo "Что-то не так";
}
?>
</body>
</html>