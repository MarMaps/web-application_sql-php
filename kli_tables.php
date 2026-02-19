<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "клиенты";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";
print '<div class="block-backgr">';
print '<div class="block-table">';

$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
//print $con;

print "<h3>Клиенты</h3>";

//$sql="select * from klienty";
$sql="select * from show_kli()";

$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>ФИО</th>
            <th>Номер телефона</th>
            <th>Паспорт</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
    $row=pg_fetch_object($result);
    $fio = $row->fio;
    $nomer_telefona = $row->nomer_telefona;
    $pasport = $row->pasport;
    
    print "<tr>
            <td>$fio</td>
            <td>$nomer_telefona</td>
            <td>$pasport</td>
        </tr>";
}

pg_close($con);

print "</div>";
print "</div>";
print "</body>";
print "</html>";
      	
?>
