<?php defined('INDEX') OR die('Прямой доступ к странице запрещён!');
/* КОМПОНЕНТ СТРАНИЦЫ */
$alias = $_GET[alias];
$query = "SELECT * FROM pages WHERE page_alias='".$alias."' AND page_publish='Y' LIMIT 1";
$db->run($query);
$db->row();
// ПЕРЕМЕННЫЕ КОМПОНЕНТА
$id = $db->data[idClients];
$alias = $db->data[surname];
$title = $db->data[name];
$h1 = $db->data[phone];
// ЕСЛИ СТРАНИЦЫ НЕ СУЩЕСТВУЕТ
if (!$id) {
header("HTTP/1.1 404 Not Found");
$component = "ОШИБКА 404! Данной страницы не существует";
}
$db->stop();