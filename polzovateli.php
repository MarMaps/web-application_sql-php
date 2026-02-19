<?php
error_reporting(0);

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>";
print "Пользователи";
print "</title>";
print '<link rel="stylesheet" href="style.css">';
print "</head>";
print "<body>";
print '<div class="block-backgr">';
print '<div class="block-table">';

$con=pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
//print $con;

print "<h3>Пользователи</h3>";

//$sql="select * from polzovateli";
$sql="select * from show_polz()";

$result=pg_query($con,$sql);
//print $result;
$n=pg_num_rows($result);
print "<table class='table' border='7' cellpadding='5'>
        <tr>
            <th>Логин</th>
            <th>Пароль</th>
            <th>Уровень допуска</th>
        </tr>";

for($i=0; $i<$n; $i++)
{
    $row=pg_fetch_object($result);
    $login = $row->login;
    $parol = $row->parol;
    $yr_dopyska = $row->yr_dopyska;
    
    print "<tr>
            <td>$login</td>
            <td>$parol</td>
            <td>$yr_dopyska</td>
        </tr>";
}

pg_close($con);

print "</div>";
print "</div>";
print "</body>";
print "</html>";
      	
?>
