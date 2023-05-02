<?php session_start();
define("INDEX", ""); // УСТАНОВКА КОНСТАНТЫ ГЛАВНОГО КОНТРОЛЛЕРА

require_once($_SERVER[DOCUMENT_ROOT]."../../connect.php"); // ПОДКЛЮЧЕНИЕ ЯДРА

// ПОДКЛЮЧЕНИЕ К БД
$db = new MyDB();
$db->connect();

// ГЛАВНЫЙ КОНТРОЛЛЕР
switch ($_GET[option]) {
case "page":
include($_SERVER[DOCUMENT_ROOT]."page.php");
break;
default:
include($_SERVER[DOCUMENT_ROOT]."home.php");
break;
}

include ($_SERVER[DOCUMENT_ROOT]."template.php");
$db->close();