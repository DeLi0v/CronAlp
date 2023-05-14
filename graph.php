<?php
    // Простая обработка формы
    if (isset($_POST['orange'], $_POST['apple'], $_POST['banana'], $_POST['tomat'], $_POST['cucumber'], $_POST['potato']))
	{
		try {
			foreach ($_POST as $value)
			{
				if (is_numeric($value)) {
					$value = intval($value)/100;
				}
				else {
					throw new Exception('Вы ввели некорректные данные');
				}
			}
			extract($_POST);
			$e = 1;
		}
		catch (Exception $ex){
			echo '<b style="color:red">'.$ex->getMessage().'</b>';
		}
	}
            
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Основы PHP</title>
<style>
   /* CSS-стили, формирующие оформление */
   body div { height:1em; display:inline-block; vertical-align:middle }
   span { display:inline-block; width:120px }
   .orange { background:orange }
   .apple { background:#33CC66 }
   .banana { background:yellow }
   .tomat { background:red }
   .cucumber { background:green }
   .potato {background:gray }
   
</style>
</head>
<body>
<h1>Форма заказа</h1>
<form method="post">
    <fieldset>
    <legend>Фрукты</legend>
        <label>Апельсины</label>
        <input name="orange" type="text" maxlength="2" placeholder="кол-во">
        <label>Яблоки</label>
        <input name="apple" type="text" maxlength="2" placeholder="кол-во">
        <label>Бананы</label>
        <input name="banana" type="text" maxlength="2" placeholder="кол-во">
   </fieldset>    
   <fieldset>
    <legend>Овощи</legend>
        <label>Помидоры</label>
        <input name="tomat" type="text" maxlength="2" placeholder="кол-во">
        <label>Огурцы</label>
        <input name="cucumber" type="text" maxlength="2" placeholder="кол-во">
        <label>Картошка</label>
        <input name="potato" type="text" maxlength="2" placeholder="кол-во">
   </fieldset>  
    <input type="submit" value="Заказать">
</form>

<?php
// Вывести результаты заказа
if (isset($e))
echo <<<EOT
   <h2>Вы заказали: </h2>
   <span>Апельсины: </span><div class="orange" style="width:{$orange}%"></div><br>
   <span>Яблоки: </span><div class="apple" style="width:{$apple}%"></div><br>
   <span>Бананы: </span><div class="banana" style="width:{$banana}%"></div><br>
   <span>Помидоры: </span><div class="tomat" style="width:{$tomat}%"></div><br>
   <span>Огурцы: </span><div class="cucumber" style="width:{$cucumber}%"></div><br>
   <span>Картошка: </span><div class="potato" style="width:{$potato}%"></div><br>
EOT;
?>
</body>
</html>