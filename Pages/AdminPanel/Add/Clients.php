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
    <form action="/Pages/AdminPanel/Add/ClientsAdd.php" method="post">
        <div class="wrapper">
            <p class="form-row">
                <label for="ClientSurname">Фамилия:</label>
                <input type="text" name="ClientSurname" size="20px" />
            </p>
            <p>
                <label for="ClientName">Имя:</label>
                <input type="text" name="ClientName" size="20px" />
            </p>
            <p class="form-row">
                <label for="ClientOtch">Отчетсво:</label>
                <input type="text" name="ClientOtch" size="20px" />
            </p>
            <p class="form-row">
                <label for="Phone">Телефон:</label>
                <input type="text" name="Phone" size="20px" />
            </p>
            <p class="form-row">
                <label for="Mail">Почта:</label>
                <input type="text" name="Mail" size="20px" />
            </p>
            <p class="form-row">
                <label for="Passwd">Пароль:</label>
                <input type="text" name="Passwd" size="20px" />
            </p>
            <input class="form-row" type="submit" value="Добавить">
        </div>
    </form>
</body>

</html>