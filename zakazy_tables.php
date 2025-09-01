<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "заказы";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";

$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
//print $con;
//$sql="select * from zakazy";
$sql = "select zakazy.id, avtomobili.marka, avtomobili.gos_nomer, klienty.fio, zakazy.data, zakazy.data_vozvrata, zakazy.status, zakazy.data_vozvrata_po_factu
		from zakazy
		inner join avtomobili  on zakazy.id_avto = avtomobili.id
		inner join klienty  on zakazy.id_klienta = klienty.id";
        
$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);

print "<h3>Заказы</h3>";
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>Авто (гос. номер)</th>
            <th>Клиент</th>
            <th>Дата</th>
            <th>Дата возврата</th>
            <th>Статус</th>
            <th>Дата возврата (по факту)</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
	$row=pg_fetch_object($result);
    $marka = $row->marka;
    $gos_nomer = $row->gos_nomer;
    $fio = $row->fio;
    $data = $row->data;
    $data_vozvrata = $row->data_vozvrata;
    $status = $row->status;
    $data_vozvrata_po_factu = $row->data_vozvrata_po_factu;
    
    print "<tr>
            <td>$marka ($gos_nomer)</td>
            <td>$fio</td>
            <td>$data</td>
            <td>$data_vozvrata</td>
            <td>$status</td>
            <td>$data_vozvrata_po_factu</td>
        </tr>";
    
    
}
print "</table>";


pg_close($con);

print "</body>";
print "</html>";
      	
?>
