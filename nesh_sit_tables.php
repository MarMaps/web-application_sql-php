<?php
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
    
    pg_query($con, $sql);
    pg_close($con);
    
    //?
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>таблица нештатных ситуаций</title>";
print "<style>
        table { border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; padding: 5px; }
        .form-container { margin-top: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; }
        .delete-container { margin-top: 20px; padding: 15px; border: 1px solid #ffcccc; background: #ffeeee; }
        .form-container input, .delete-container input { margin: 5px 0; width: 300px; }
        .form-container label, .delete-container label { display: inline-block; width: 150px; }
    </style>";
print "</head>";
print "<body>";

$con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');

print "<h3>Нештатные ситуации</h3>";
$sql = "SELECT * FROM neshtatnye_situacii ORDER BY id";
$result = pg_query($con, $sql);

print "<table>
        <tr>
            <th>ID</th>
            <th>id_заказа</th>
            <th>описание</th>
            <th>сумма штрафа</th>
        </tr>";

while ($row = pg_fetch_assoc($result)) {
    print "<tr>
            <td><b>{$row['id']}</b></td>
            <td>{$row['id_zakaza']}</td>
            <td>{$row['opisanie']}</td>
            <td>{$row['summa_shtrafa']}</td>
        </tr>";
}

print "</table>";

print "</body>";
print "</html>";
?>