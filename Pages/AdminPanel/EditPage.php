<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php include("../../head.php"); ?>

<?php if (isset($_POST["id"]) && isset($_POST["page"])) {
    
    // Подключение файла для связи с БД
    require_once("../../connect.php"); 

    // // Подключение к БД
    $db = new DB_Class();
    $conn = $db->connect();
    mysqli_select_db($conn, $db->database);

    $id = $_POST["id"];
    $page = $_POST["page"];

    if ($page = "Clients") {
        // Запрос
        $sql = "SELECT * FROM Clients WHERE idClient = $id;";
        // Выполняем SQL-запрос
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $surname =  $row["ClientSurname"];
                $name =  $row["ClientName"];
                $otch =  $row["ClientOtch"];
                $phone =  $row["Phone"];
                $mail =  $row["Mail"];
                $passwd =  $row["Passwd"];
            }
        }
?>
    <h3 style="text-align:center;">Изменение данных о клиенте</h3>
    <form class="add" action="/Pages/AdminPanel/Edit.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Фамилия:</label>
                <input type="text" name="Surname" size="20px" value="<?php echo $surname?>"/>
            </li>
            <li class="form-row">
                <label for="Name">Имя:</label>
                <input type="text" name="Name" size="20px" value="<?php echo $name?>"/>
            </li>
            <li class="form-row">
                <label for="Otch">Отчетсво:</label>
                <input type="text" name="Otch" size="20px" value="<?php echo $otch?>"/>
            </li>
            <li class="form-row">
                <label for="Phone">Телефон:</label>
                <input type="tel" name="Phone" size="20px" value="<?php echo $phone?>"/>
            </li>
            <li class="form-row">
                <label for="Mail">Почта:</label>
                <input type="email" name="Mail" size="20px" value="<?php echo $mail?>"/>
            </li>
            <li class="form-row">
                <label for="Passwd">Пароль:</label>
                <input type="text" name="Passwd" size="20px" value="<?php echo $passwd?>"/>
            </li>
<?php
    } elseif ($page = "Clients") {
?>

<?php } ?>
            <li class="form-row">
                <?php 
                    echo "<input type=\"hidden\" name=\"id\" value=\"$id\">
                        <input type=\"hidden\" name=\"page\" value=\"$page\">";
                ?>
                <button type="submit">Изменить</button>
            </li>
        </ul>
    </form>
</body>

<?php 
} else {
    echo "Что-то не так";
}
?>

</html>
