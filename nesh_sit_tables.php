<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "нештатные ситуации";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";

$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
//print $con;

print "<h3>Нештатные ситуации</h3>";
$sql="select * from neshtatnye_situacii";
$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>№ заказа</th>
            <th>описание</th>
            <th>сумма штарафа</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
    $row=pg_fetch_object($result);
    $id_zakaza = $row->id_zakaza;
    $opisanie = $row->opisanie;
    $summa_shtrafa = $row->summa_shtrafa;
    
    print "<tr>
            <td>$id_zakaza</td>
            <td>$opisanie</td>
            <td>$summa_shtrafa</td>
        </tr>";
}

pg_close($con);

print "</body>";
print "</html>";
      	
?>
