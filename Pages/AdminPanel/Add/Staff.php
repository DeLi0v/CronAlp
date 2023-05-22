<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="staff-add">
    <?php 
    session_name("account");
    session_start();
    if(isset($_SESSION["LogIn"]) && $_SESSION["LogIn"] == 1 && isset($_SESSION["idStaff"])) { ?>

    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Добавление сотрудника</h3>
    <form class="add" action="/Pages/AdminPanel/Add/StaffAdd.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Surname">Фамилия:</label>
                <input type="text" name="Surname" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Name">Имя:</label>
                <input type="text" name="Name" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Otch">Отчетсво:</label>
                <input type="text" name="Otch" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Phone">Телефон:</label>
                <input type="text" name="Phone" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Mail">Почта:</label>
                <input type="email" name="Mail" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Mail">Должность:</label>
                <input type="text" name="Post" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Passwd">Пароль:</label>
                <input type="text" name="Passwd" size="20px" required/>
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>
    
    <?php } else { header("Location: /index.php"); } ?>
</body>

</html>