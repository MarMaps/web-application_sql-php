<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления заказа(клиент)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="block-backgr">
<div class="block-form">	

    <h3>Добавление заказа: </h3>
    
    <form method="get" action="">
		
    <label class="label" for="fio">ФИО</label>
    <input class="area" type="text" name="fio" required> <br>

    <label class="label" for="nomer_telefona">Номер телефона</label>
    <input class="area" type="text" name="nomer_telefona" required> <br>

    <label class="label" for="pasport">Паспорт</label>
    <input class="area" type="text" name="pasport"> <br>
    <p>============</p>
    <label class="label" for="id_avto">Выберите автомобиль:</label>
    <select class="area" name="id_avto" required>
    <option value=""></option>
    <?php
        $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
        
        // $sql_avto = "select a.id, a.marka, a.model, a.gos_nomer, a.sostoyanie 
        //             from avtomobili a
        //             where (a.sostoyanie is null) and (a.id not in ( 
        //                 select z.id_avto 
        //                 from zakazy z 
        //                 where z.status = 'у клиента'
        //             ))";
        $sql_avto = "select * from get_available_avtomobili()";
                    
        $result_avto = pg_query($con, $sql_avto);
        
        while ($row_avto = pg_fetch_assoc($result_avto)) {
            print "<option value='{$row_avto['id']}'>
                    {$row_avto['marka']} {$row_avto['model']} ({$row_avto['gos_nomer']})
                </option>";
        }
    ?>

    </select><br>    

        <label class="label" for="data">Дата (дд.мм.гггг):</label>
        <input class="area" type="text" name="data" required><br>

        <label class="label" for="data_vozvrata">Дата возврата (дд.мм.гггг):</label>
        <input class="area" type="text" name="data_vozvrata" required><br>
        
        <input class="btn_dob" name='btn' type='submit' value='Заказать'>
    </form>

<?php
    if (isset($_GET['btn'])) {
        $fio = trim($_GET['fio']);
        $nomer_telefona = trim($_GET['nomer_telefona']);
        $pasport = trim($_GET['pasport']);
        $id_avto = trim($_GET['id_avto']);
        $data = trim($_GET['data']);
        $data_vozvrata = trim($_GET['data_vozvrata']);
        
        $check_sql = "SELECT id FROM klienty WHERE fio = '$fio' AND nomer_telefona = '$nomer_telefona'";
		$check_result = pg_query($con, $check_sql);
		
		if (pg_num_rows($check_result) > 0) {
        $row = pg_fetch_assoc($check_result);
        $id_klienta = $row['id'];
        echo "<p>Найден существующий клиент</p>";
    } else {
        $insert_klient_sql = "INSERT INTO klienty (fio, nomer_telefona, pasport) 
                             VALUES ('$fio', '$nomer_telefona', '$pasport') 
                             RETURNING id";
        $insert_result = pg_query($con, $insert_klient_sql);
        
        if ($insert_result) {
            $row = pg_fetch_assoc($insert_result);
            $id_klienta = $row['id'];
            echo "<p>Создан новый клиент</p>";
        } else {
            echo "<p style='color: red;'>Ошибка при создании клиента: " . pg_last_error($con) . "</p>";
			pg_close($con);
            exit;
          }
    }
    
    $status = "на базе";
    $sql = "INSERT INTO zakazy (id_avto, id_klienta, data, data_vozvrata, status) 
            VALUES ('$id_avto', '$id_klienta', '$data', '$data_vozvrata', '$status')";
    
    $result = pg_query($con, $sql);
    
    if ($result) {
        echo "<p'>ваш заказ добавлен</p>";
    } else {
        echo "<p'>ошибка: " . pg_last_error($con) . "</p>";
    }
    
}
    pg_close($con);
?>

</div>
</div>
</body>
</html>
