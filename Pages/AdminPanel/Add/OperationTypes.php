<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
</head>

<body class="equepmentCat-add">
    <?php include("../../../head.php"); ?>
    <h3 style="text-align:center;">Добавление вида услуг</h3>
    <form action="/Pages/AdminPanel/Add/OperationTypesAdd.php" method="post" style=" margin:auto; width:500px;">
        <ul class="wrapper">
            <li class="form-row">
                <label for="Name">Наименование:</label>
                <input type="text" name="Name" size="20px" />
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>
</body>

</html>