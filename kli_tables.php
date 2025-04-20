<?php
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
    
    //доб клиента
    if (isset($_POST['add_client'])) {
        $fio = pg_escape_string($con, $_POST['fio']);
        $nomer_telefona = pg_escape_string($con, $_POST['nomer_telefona']);
        $pasport = pg_escape_string($con, $_POST['pasport']);
        
        $sql = "INSERT INTO klienty (fio, nomer_telefona, pasport) 
                VALUES ('$fio', '$nomer_telefona', '$pasport')";
    }
    
    //уд клиента
    if (isset($_POST['delete_client'])) {
        $id_to_delete = (int)$_POST['client_id'];
        $sql = "DELETE FROM klienty WHERE id = $id_to_delete";
    }
    
    pg_query($con, $sql);
    pg_close($con);
    
    // ?
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>таблица клиентов</title>";
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

print "<h3>Клиенты</h3>";
$sql = "SELECT * FROM klienty ORDER BY id";
$result = pg_query($con, $sql);

print "<table>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Номер телефона</th>
            <th>Паспорт</th>
        </tr>";

while ($row = pg_fetch_assoc($result)) {
    print "<tr>
            <td><b>{$row['id']}</b></td>
            <td>{$row['fio']}</td>
            <td>{$row['nomer_telefona']}</td>
            <td>{$row['pasport']}</td>
        </tr>";
}

print "</table>";

//добавление
print '<div class="form-container">
        <h4>Добавить нового клиента</h4>
        <form method="POST">
            <input type="hidden" name="add_client" value="1">
            <div>
                <label>ФИО:</label>
                <input type="text" name="fio" required>
            </div>
            <div>
                <label>Номер телефона:</label>
                <input type="text" name="nomer_telefona" required>
            </div>
            <div>
                <label>Паспорт:</label>
                <input type="text" name="pasport" required>
            </div>
            <input type="submit" value="Добавить">
        </form>
    </div>';

//удаление
print '<div class="delete-container">
        <h4>Удаление клиента</h4>
        <form method="POST">
            <input type="hidden" name="delete_client" value="1">
            <div>
                <label>Укажите ID клиента:</label>
                <input type="number" name="client_id" required>
            </div>
            <input type="submit" value="Удалить">
        </form>
    </div>';

pg_close($con);

print "</body>";
print "</html>";
?>