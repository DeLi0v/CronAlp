<?php 
    include_once("cookee.php"); 
    startmysession(0,"/", "account",true,false); 
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php
    // session_name("account");
    // session_start();

    if (isset($_SESSION["LogIn"])) {
        if ($_SESSION["LogIn"] <> 1) {
            $_SESSION["LogIn"] = 0;
        }
    } else {
        $_SESSION["LogIn"] = 0;
    }

    $LogIn = $_SESSION["LogIn"];
    $page = "account";

    if (isset($_GET["no"])) {
        $err = $_GET["no"];
    } else {
        $err = 0;
    } ?>
    <?php if ($LogIn == 0) { ?>
        <?php include_once("../../MainNavigation.php") ?>
        <form class="add" action="/Pages/Account/logining.php" method="post" style=" margin:auto; width:500px;">
            <h3 style="text-align:center;">Вход в аккаунт</h3>
            <ul class="wrapper">
                <li class="form-row">
                    <label for="phone">Телефон:</label>
                    <input type="text" name="phone" size="20px" required/>
                </li>
                <li class="form-row">
                    <label for="passwd">Пароль:</label>
                    <input type="password" name="passwd" size="20px" required/>
                </li>
                <?php if ($err == 1) { ?>
                    <li class="form-row-error">
                        <label>Неверно введен телефон или пароль</label>
                    </li>
                <?php } ?>
                <li class="from-row" style="justify-content: center;display: flex;font-size: small;">
                    <a href="/Pages/Account/register_page.php">Зарегестрироваться</a>
                </li>
                <li class="form-row">
                    <button type="submit">Войти</button>
                </li>
            </ul>
        </form>
    <?php } else {
        header("Location: logining.php");
    } ?>
</body>

</html>