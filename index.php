<?php
error_reporting(0);
session_start();

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "main_for_admin";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";

print '<h1>Веб-приложение базы данных по прокату авто</h1>';
$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');

if (!empty($_SESSION['auth'])) {
	print "login = " . $_SESSION['user']['login'];    
    print " yroven = " . $_SESSION['user']['yr_dopyska'];
}
print "<p>";

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
//убрать удаление(позже будет замена на добавление в какой-то архив )
//print '<a class="btn-del" href="del_avto.php">Удалить автомобиль</a><br>';
//print '<a class="btn-del" href="del_kli.php">Удалить клиента</a><br>';

print "<p>";
print '<a class="btn-report" href="otchet.php">ОТЧЕТ</a><br>';
print '<a class="btn-report" href="polzovateli.php">Список пользователей</a><br>';
print '<a class="btn-report" href="add_yr_dop.php">Установить/изменить уровень допуска пользователям</a><br>';

pg_close($con);

print "</body>";
print "</html>";     	
?>
