<!DOCTYPE html>
<html>

<head>
    <?php include_once("MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php $page = "account" ?>
    <?php include_once("MainNavigation.php") ?>
    <form class="add" action="/Pages/AdminPanel/adminpanel.php" method="post" style=" margin:auto; width:500px;">
        <h3 style="text-align:center;">Вход в административную панель</h3>
        <ul class="wrapper">
            <li class="form-row">
                <label for="login">Телефон:</label>
                <input type="text" name="login" size="20px" />
            </li>
            <li class="form-row">
                <label for="passwd">Пароль:</label>
                <input type="text" name="passwd" size="20px" />
            </li>
            <li class="form-row">
                <button type="submit">Войти</button>
            </li>
        </ul>
    </form>

</body>

</html>  