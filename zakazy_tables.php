<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "таблица заказов";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";

$con=pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
//print $con;
//$sql="select * from zakazy";
$sql = "select zakazy.id, avtomobili.marka, zakazy.id_avto, klienty.fio, zakazy.data, zakazy.data_vozvrata, zakazy.status 
		from zakazy
		inner join avtomobili  on zakazy.id_avto = avtomobili.id
		inner join klienty  on zakazy.id_klienta = klienty.id";
        
$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);

print "<h3>Заказы</h3>";
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>Авто (ID)</th>
            <th>Клиент</th>
            <th>Дата</th>
            <th>Дата возврата</th>
            <th>Статус</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
	$row=pg_fetch_object($result);
	$id =  $row->id;
    $marka = $row->marka;
    $id_avto = $row->id_avto;
    $fio = $row->fio;
    $data = $row->data;
    $data_vozvrata = $row->data_vozvrata;
    $status = $row->status;
    
    
    print "<tr>
            <td><b>$id</b></td>
            <td>$marka ($id_avto)</td>
            <td>$fio</td>
            <td>$data</td>
            <td>$data_vozvrata</td>
            <td>$status</td>
        </tr>";
    
    
}
print "</table>";


pg_close($con);

print "</body>";
print "</html>";
      	
?>
