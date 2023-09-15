<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="equepment-add">
<?php include("../head.php"); ?>
<?php
if (isset($_POST["Name"]) && isset($_POST["Category"]) && isset($_POST["Size"]) && isset($_POST["Storage"]) && isset($_POST["Price"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $name = $conn->real_escape_string($_POST["Name"]);
    $category = $conn->real_escape_string($_POST["Category"]);
    $size = $conn->real_escape_string($_POST["Size"]);
    $storage = $conn->real_escape_string($_POST["Storage"]);
    $price = $conn->real_escape_string($_POST["Price"]);

    $sql = "INSERT INTO Equepments (EquepmentName, idCategory, size, storage) VALUES ('$name', '$category', '$size', '$storage', '$price');";
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