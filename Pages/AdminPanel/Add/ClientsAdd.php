<?php
if (isset($_POST["ClientSurname"]) && isset($_POST["ClientName"]) && isset($_POST["ClientOtch"]) && isset($_POST["Phone"]) && isset($_POST["Mail"]) && isset($_POST["Passwd"])) {
      
    require_once("../../../connect.php"); // Подключение файла для связи с БД

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $surname = $conn->real_escape_string($_POST["ClientSurname"]);
    $name = $conn->real_escape_string($_POST["ClientName"]);
    $otch = $conn->real_escape_string($_POST["ClientOtch"]);
    $phone = $conn->real_escape_string($_POST["Phone"]);
    $mail = $conn->real_escape_string($_POST["Mail"]);
    $passwd = $conn->real_escape_string($_POST["Passwd"]);

    $sql = "INSERT INTO \`mydb\`.\`Clients\` (\`ClientSurname\`, \`ClientName\`, \`ClientOtch\`, \`Phone\`, \`Mail\`, \`Passwd\`) VALUES ($surname, $name, $otch, $phone, $mail, $passwd);";
    if($conn->query($sql)){
        echo "Данные успешно добавлены";
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>