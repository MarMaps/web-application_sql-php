<?php
error_reporting(0);
session_start();

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "main_for_klient";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";
print '<div class="block-backgr">';

print '<h1>Веб-приложение базы данных по прокату авто для клиентов</h1>';
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
print '<a class="btn-tables" href="avto_tables_kli.php">Автомобили</a><br>';
print "<p>";
//сделано
print '<a class="btn-add" href="add_zakaz_klienta.php">Заказать авто</a><br>';
print '</div>';

pg_close($con);
print '</div>';
print "</body>";
print "</html>";     	
?>
