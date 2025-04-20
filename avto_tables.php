<?php
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
    
    //доб автомобиля
    if (isset($_POST['add_car'])) {
        $marka = pg_escape_string($con, $_POST['marka']);
        $model = pg_escape_string($con, $_POST['model']);
        $god_vypuska = (int)$_POST['god_vypuska'];
        $moschnost = (int)$_POST['moschnost'];
        $stoimost_za_chas = (float)$_POST['stoimost_za_chas'];
        
        $sql = "INSERT INTO avtomobili (marka, model, god_vypuska, moschnost, stoimost_za_chas) 
                VALUES ('$marka', '$model', $god_vypuska, $moschnost, $stoimost_za_chas)";
        
        pg_query($con, $sql);
    }
    
    //уд автомобиля
    if (isset($_POST['delete_car'])) {
        $id_to_delete = (int)$_POST['car_id'];
        $sql = "DELETE FROM avtomobili WHERE id = $id_to_delete";
        pg_query($con, $sql);
    }
    
    pg_close($con);
    
    //?
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

print "<html>";
print "<head>";
print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
print "<title>таблица авто</title>";
print "<style>
        table { border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; padding: 5px; }
        .form-container { margin-top: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; }
        .form-container input { margin: 5px 0; }
        .delete-form { margin-top: 20px; padding: 15px; border: 1px solid #ffcccc; background: #ffeeee; }
    </style>";
print "</head>";
print "<body>";

$con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');

print "<h3>Автомобили</h3>";
$sql = "SELECT * FROM avtomobili ORDER BY id";
$result = pg_query($con, $sql);

print "<table>
        <tr>
            <th>ID</th>
            <th>Марка</th>
            <th>Модель</th>
            <th>Год выпуска</th>
            <th>Мощность</th>
            <th>Стоимость/час</th>
        </tr>";

while ($row = pg_fetch_assoc($result)) {
    print "<tr>
            <td><b>{$row['id']}</b></td>
            <td>{$row['marka']}</td>
            <td>{$row['model']}</td>
            <td>{$row['god_vypuska']}</td>
            <td>{$row['moschnost']}</td>
            <td>{$row['stoimost_za_chas']}</td>
        </tr>";
}

print "</table>";

//добавление
print '<div class="form-container">
        <h4>Добавить новый автомобиль</h4>
        <form method="POST">
            <input type="hidden" name="add_car" value="1">
            <div>
                <label>Марка:</label><br>
                <input type="text" name="marka" required>
            </div>
            <div>
                <label>Модель:</label><br>
                <input type="text" name="model" required>
            </div>
            <div>
                <label>Год выпуска:</label><br>
                <input type="number" name="god_vypuska" required>
            </div>
            <div>
                <label>Мощность (л.с.):</label><br>
                <input type="number" name="moschnost" required>
            </div>
            <div>
                <label>Стоимость/час:</label><br>
                <input type="number" step="0.01" name="stoimost_za_chas" required>
            </div>
            <input type="submit" value="Добавить">
        </form>
    </div>';

//удаление
print '<div class="delete-form">
        <h4>Удаление автомобиля</h4>
        <form method="POST">
            <input type="hidden" name="delete_car" value="1">
            <div>
                <label>Укажите ID автомобиля:</label><br>
                <input type="number" name="car_id" required>
            </div>
            <input type="submit" value="Удалить">
        </form>
    </div>';

pg_close($con);

print "</body>";
print "</html>";
?>