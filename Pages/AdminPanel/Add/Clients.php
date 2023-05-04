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
    <h3>Добавление пользователя</h3>
    <form action="/Pages/AdminPanel/Add/Add.php" method="post">
        <p>Фамилия:
            <input type="text" name="ClientSurname" />
        </p>
        <p>Имя:
            <input type="text" name="ClientName" />
        </p>
        <p>Отчетсво:
            <input type="text" name="ClientOtch" />
        </p>
        <p>Телефон:
            <input type="number" name="Phone" />
        </p>
        <p>Почта:
            <input type="number" name="userage" />
        </p>
        <p>Пароль:
            <input type="text" name="Passwd" />
        </p>
        <input type="submit" value="Добавить">
    </form>
    <?php
    require("Add.php");
    ?>
</body>