<!DOCTYPE html>
<html>

<head>
    <?php include_once("MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    $page = "account"; 
    if(isset($_POST["no"])){
        $error = $_POST["no"];
    } else {$error = 0;}?>
    <?php include_once("MainNavigation.php") ?>
    <form class="add" action="/Pages/AdminPanel/adminpanel.php" method="post" style=" margin:auto; width:500px;">
        <h3 style="text-align:center;">Вход в административную панель</h3>
        <ul class="wrapper">
            <li class="form-row">
                <label for="phone">Телефон:</label>
                <input type="text" name="phone" size="20px" />
            </li>
            <li class="form-row">
                <label for="passwd">Пароль:</label>
                <input type="password" name="passwd" size="20px" />
            </li>
            <?php if($error == 1) { ?>
            <li class="form-row-error">
                <label>Неверно введен телефон/пароль</label>
            </li>
            <?php } ?>
            <li class="form-row">
                <button type="submit">Войти</button>
            </li>
        </ul>
    </form>

</body>

</html>  