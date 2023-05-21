<!DOCTYPE html>
<html>

<head>
    <?php include("../../MainHead.php") ?>
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body>
    <?php 
    $page = "account"; 

    // получение типа ошибки
    if (isset($_GET["p"]) && isset($_GET["m"])) {
        $p = $_GET["p"];
        $m = $_GET["m"];
    } else {
        $p = 0;
        $m = 0;
    } 
    
    // Получение введенных данных
    session_name("register");
    session_start();
    if (isset($_SESSION["surname"]) && isset($_SESSION["name"]) && isset($_SESSION["otch"]) && isset($_SESSION["phone"]) && isset($_SESSION["mail"])) {
        $dataErr = 1;
    } else { $dataErr = 0; } 
    ?>

    <?php include("../../MainNavigation.php"); ?>

    <h3 style="text-align:center;">Регистрация</h3>
    <form class="add" action="/Pages/Account/register.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Фамилия:</label>
                <input type="text" name="Surname" size="20px" <?php if ($dataErr == 1) { echo "value=".$_SESSION['surname'].""; } ?> required/>
            </li>
            <li class="form-row">
                <label for="Name">Имя:</label>
                <input type="text" name="Name" size="20px" <?php if ($dataErr == 1) { echo "value=".$_SESSION['name'].""; } ?> required/>
            </li>
            <li class="form-row">
                <label for="Otch">Отчетсво:</label>
                <input type="text" name="Otch" size="20px" <?php if ($dataErr == 1) { echo "value=".$_SESSION['otch'].""; } ?> required/>
            </li>
            <li class="form-row">
                <label for="Phone">Телефон:</label>
                <input type="tel" name="Phone" size="20px" <?php if ($dataErr == 1) { echo "value=".$_SESSION['phone'].""; } ?> required/>
            </li>
            <li class="form-row">
                <label for="Mail">Почта:</label>
                <input type="email" name="Mail" size="20px" <?php if ($dataErr == 1) { echo "value=".$_SESSION['mail'].""; } ?> required/>
            </li>
            <li class="form-row">
                <label for="passwd">Пароль:</label>
                <input type="password" name="passwd" size="20px" required/>
            </li>
            <?php if ($m == 1 || $p == 1) { ?>
                    <li class="form-row-error">
                        <?php if ($m == 1 && $p == 1) { ?>
                            <label>Аккаунт с такой потой и телефоном уже сущесвует</label>
                        <?php } elseif ($m == 1 && $p == 0) { ?>
                            <label>Аккаунт с такой почтой уже существует</label>
                        <?php } else { ?>
                            <label>Аккаунт с таким телефоном уже существует</label>
                        <?php } ?>
                    </li>
                <?php } ?>
            <li class="form-row">
                <button type="submit">Зарегестрироваться</button>
            </li>
        </ul>
    </form>
</body>

</html>