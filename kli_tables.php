<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "таблица клиентов";
print "</title>";
print "</head>";
print "<body>";

$con=pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
//print $con;

print "<h3>Клиенты</h3>";
$sql="select * from klienty";
$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);
print "<table border='1' cellpadding='5' style='border-collapse: collapse; margin-bottom: 20px;'>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Номер телефона</th>
            <th>Паспорт</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
    $row=pg_fetch_object($result);
    $id =  $row->id;
    $fio = $row->fio;
    $nomer_telefona = $row->nomer_telefona;
    $pasport = $row->pasport;
    
    print "<tr>
            <td><b>$id</b></td>
            <td>$fio</td>
            <td>$nomer_telefona</td>
            <td>$pasport</td>
        </tr>";
}

pg_close($con);

print "</body>";
print "</html>";
      	
?>
