<?php
error_reporting(0);
session_start();

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "main_for_sotrud";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";
print '<div class="block-backgr">';

print '<h1>Веб-приложение базы данных по прокату авто для сотрудников</h1>';
$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');

if (!empty($_SESSION['auth'])) {
	print "login = " . $_SESSION['user']['login'];    
    print " yroven = " . $_SESSION['user']['yr_dopyska'];
}
print "<p>";

print '<div class="block-out">';
print '<a class="btn-del" href="logout.php">Выйти</a><br>';
print '</div>';

print '<div class="block-main">';
print '<a class="btn-tables" href="avto_tables.php">Автомобили</a><br>';
print '<a class="btn-tables" href="kli_tables.php">Клиенты</a><br>';
print '<a class="btn-tables" href="nesh_sit_tables.php">Нештатные ситуации</a><br>';
print '<a class="btn-tables" href="zakazy_tables.php">Заказы</a><br>';

print "<p>";
print '<a class="btn-add" href="add_avto.php">Добавить автомобиль</a><br>';
print '<a class="btn-add" href="add_kli.php">Добавить клиента</a><br>';
print '<a class="btn-add" href="add_zakaz.php">Добавить заказ</a><br>';
print '<a class="btn-add" href="dob_Dzakaza_poF.php">Добавить к заказу дату возврата</a><br>';
print '<a class="btn-add" href="add_nesh_sit.php">Добавить нештатную ситуацию</a><br>';
print '<a class="btn-add" href="izm_statusa.php">Изменение статуса у заказа</a><br>';

print "<p>";
print '<a class="btn-report" href="otchet.php">ОТЧЕТ</a><br>';
print '</div>';

pg_close($con);
print '</div>';

print "</body>";
print "</html>";     	
?>
