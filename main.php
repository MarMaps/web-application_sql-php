<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "main";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";

print '<h1>Веб-приложение *Прокат автомобилей* Голубева 230Б </h1>';
$con=pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');

print '<a class="btn-tables" href="avto_tables.php">Таблица Автомобили</a><br>';
print '<a class="btn-tables" href="kli_tables.php">Таблица Клиенты</a><br>';
print '<a class="btn-tables" href="nesh_sit_tables.php">Таблица Нештатные ситуации</a><br>';
print '<a class="btn-tables" href="zakazy_tables.php">Таблица Заказы</a><br>';

print "<p>";
print '<a class="btn-add" href="add_avto.php">Добавить автомобиль</a><br>';
print '<a class="btn-add" href="add_kli.php">Добавить клиента</a><br>';
print '<a class="btn-add" href="add_zakaz.php">Добавить заказ</a><br>';
print '<a class="btn-add" href="add_nesh_sit.php">Добавить нештатную ситуацию</a><br>';

print "<p>";
print '<a class="btn-del" href="del_avto.php">Удалить автомобиль</a><br>';
print '<a class="btn-del" href="del_kli.php">Удалить клиента</a><br>';

print "<p>";
print '<a class="btn-report" href="otchet.php">ОТЧЕТ</a><br>';

pg_close($con);

print "</body>";
print "</html>";     	
?>
