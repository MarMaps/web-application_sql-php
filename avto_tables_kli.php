<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "авто";
print "</title>";
//print '<link rel="stylesheet" href="style.css">';
print '<link rel="stylesheet" href="style.css?v=' . time() . '">';
print "</head>";
print "<body>";
print '<div class="block-backgr">';
print '<div class="block-table">';

$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
//print $con;

//$sql="select * from avtomobili a where a.sostoyanie <> 'списан' or a.sostoyanie is null"; //без списанных
//$sql="select * from show_avto()"; //все
$sql="select * from show_avto_for_kli()"; //функцией без списанных

$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);

print "<h3>Автомобили</h3>";
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>Марка</th>
            <th>Модель</th>
            <th>Год выпуска</th>
            <th>Мощность</th>
            <th>Стоимость/час</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
	$row=pg_fetch_object($result);
    $marka = $row->marka;
    $model = $row->model;
    $god_vypuska = $row->god_vypuska;
    $moschnost = $row->moschnost;
    $stoimost_za_chas = $row->stoimost_za_chas;
    $gos_nomer = $row->gos_nomer;
    $sostoyanie = $row->sostoyanie;
    
    print "<tr>
            <td>$marka</td>
            <td>$model</td>
            <td>$god_vypuska</td>
            <td>$moschnost</td>
            <td>$stoimost_za_chas</td>
        </tr>";
    
    
}
print "</table>";

pg_close($con);

print "</div>";
print "</div>";
print "</body>";
print "</html>";
      	
?>
