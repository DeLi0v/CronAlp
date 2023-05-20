<!DOCTYPE html>
<html>

<?php include("../../../htmlHead.php") ?>

<body class="clients-add">
    <?php include("../head.php"); ?>
    <h3 style="text-align:center;">Добавление клиента</h3>
    <form class="add" action="/Pages/AdminPanel/Add/ClientsAdd.php" method="post" style=" margin:auto; width:500px;">
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
                <input type="tel" name="Phone" size="20px" required/>
            </li>
            <li class="form-row">
                <label for="Mail">Почта:</label>
                <input type="email" name="Mail" size="20px" required/>
            </li>
            <li class="form-row">
                <button type="submit">Добавить</button>
            </li>
        </ul>
    </form>
</body>

</html>