<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "таблица авто";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";

$con=pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
//print $con;
$sql="select * from avtomobili";
$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);

print "<h3>Автомобили</h3>";
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Марка</th>
            <th>Модель</th>
            <th>Год выпуска</th>
            <th>Мощность</th>
            <th>Стоимость/час</th>
            <th>Гос. номер</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
	$row=pg_fetch_object($result);
	$id =  $row->id;
    $marka = $row->marka;
    $model = $row->model;
    $god_vypuska = $row->god_vypuska;
    $moschnost = $row->moschnost;
    $stoimost_za_chas = $row->stoimost_za_chas;
    $gos_nomer = $row->gos_nomer;
    
    
    print "<tr>
            <td><b>$id</b></td>
            <td>$marka</td>
            <td>$model</td>
            <td>$god_vypuska</td>
            <td>$moschnost</td>
            <td>$stoimost_za_chas</td>
            <td>$gos_nomer</td>
        </tr>";
    
    
}
print "</table>";


pg_close($con);

print "</body>";
print "</html>";
      	
?>
