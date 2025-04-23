<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "main";
print "</title>";
print "</head>";
print "<body>";

/*print '
<style type="text/css">
   a { 
    display: block;
    padding-bottom: 15px;
   }
  </style>

';*/
print '<h2>Веб-приложение по БД Голубева 230Б</h2>';
$con=pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');

print '<a href="avto_tables.php">Таблица Автомобили</a>';
print"<br>";
print '<a href="kli_tables.php">Таблица Клиенты</a>';
print"<br>";
print '<a href="nesh_sit_tables.php">Таблица Нештатные ситуации</a>';

print "<p>";
print '<a href="forma_dob_avto.php">Добавить автомобиль</a>';

print "<p>";
print '<a href="del_avto2IN1.php">Удалить автомобиль</a>';

pg_close($con);


print "</body>";
print "</html>";
      	
?>
