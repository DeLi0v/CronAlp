<?php 
    include_once("cookee.php"); 
    startmysession(0,"/", "account",true,false); 
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once("MainHead.php") ?>
</head>

<body>

    <?php 
    $page = "main";   

    if(isset($_SESSION["LogIn"])) {
        if ($_SESSION["LogIn"] <> 1) { $_SESSION["LogIn"] = 0; }
        echo $_SESSION["LogIn"];
    } else { $_SESSION["LogIn"] = 0; }
    ?>

    <?php include_once("MainNavigation.php") ?>

    <h3 style="text-align: center;">Добро пожаловать на сайт горнолыжного курорта "Альпийская крона!"</h3>
    <p>В данный момент сайт находится в разработке, поэтому работает только часть функций, а дизайн является лишь прототипом.
        <br>В процессе разработки дизайн будет меняться, а также будут добавляться новые функции!
    </p>

</body>

</html>