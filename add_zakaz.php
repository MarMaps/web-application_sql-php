<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления заказа</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Добавление заказа: </h3>
    
    <form method="get" action="">
        <label class="label" for="id_avto">Автомобиль(ID):</label>
        <select class="area" name="id_avto" required>
            <option value=""></option>
            <?php
            $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
            $sql_avto = "select id, marka, model from avtomobili";
            $result_avto = pg_query($con, $sql_avto);
            
            while ($row_avto = pg_fetch_assoc($result_avto)) {
                print "<option value='{$row_avto['id']}'>{$row_avto['marka']} {$row_avto['model']} ({$row_avto['id']})</option>";
            }
            ?>
        </select><br>

        <label class="label" for="id_klienta">Клиент(ID):</label>
        <select class="area" name="id_klienta" required>
            <option value=""></option>
            <?php
            $sql_klient = "select id, fio from klienty";
            $result_klient = pg_query($con, $sql_klient);
            
            while ($row_klient = pg_fetch_assoc($result_klient)) {
                print "<option value='{$row_klient['id']}'>{$row_klient['fio']} ({$row_klient['id']})</option>";
            }
            ?>
        </select><br>

        <label class="label" for="data">Дата (дд.мм.гггг):</label>
        <input class="area" type="text" name="data" required><br>

        <label class="label" for="data_vozvrata">Дата возврата (дд.мм.гггг):</label>
        <input class="area" type="text" name="data_vozvrata" required><br>

        <label class="label" for="status">Статус:</label>
        <input class="area" type="text" name="status" required><br>
        
        <input class="btn_dob" name='btn' type='submit' value='Добавить'>
    </form>

    <?php
    if (isset($_GET['btn'])) {
        $id_avto = trim($_GET['id_avto']);
        $id_klienta = trim($_GET['id_klienta']);
        $data = trim($_GET['data']);
        $data_vozvrata = trim($_GET['data_vozvrata']);
        $status = trim($_GET['status']);
    
        if ($id_avto != '' && $id_klienta != '') {
            $sql = "insert into zakazy (id_avto, id_klienta, data, data_vozvrata, status) 
                    values ('$id_avto', '$id_klienta', '$data', '$data_vozvrata', '$status')";
            $result = pg_query($con, $sql);
    
            if ($result) {
                print "<p>👍</p>";
            }
        }
    }
    
    pg_close($con);
    ?>
</body>
</html>
