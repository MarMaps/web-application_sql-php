<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение статуса</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="block-backgr">
<div class="block-form">
	
    <h3>Изменение статуса у заказа: </h3>
    
    <form method="get" action="">
		
        <label class="label" for="nom_zak">Выберите номер заказа:</label>
        <select class="area" name="nom_zak" required>
            <option value=""></option>
            <?php
				$con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
				$sql_nom = "select id, nomer_zakaza from zakazy";
				$result_nom = pg_query($con, $sql_nom);
            
				while ($row_nom = pg_fetch_assoc($result_nom)) {
					print "<option value='{$row_nom['id']}'>{$row_nom['nomer_zakaza']}</option>";
				}
            ?>
        </select><br>
        
        <label class="label" for="new_status">Укажите новый статус:</label>
        <input class="area" type="text" name="new_status" required><br>
        
        <input class="btn_dob" name='btn' type='submit' value='Обновить'>
    </form>

    <?php
		if (isset($_GET['btn'])) {
			$id_zakaz = $_GET['nom_zak'];
			$status = $_GET['new_status'];

			if ($id_zakaz != '' && $status != '') {
				//$sql_update = "update zakazy set status = '$status' where id = '$id_zakaz'";
				$sql_update = "select izm_statusa('$id_zakaz', '$status')";
				$result_update = pg_query($con, $sql_update);

				if ($result_update) {
					echo "<p>👍</p>";
				} else {
					echo "<p>ошибка</p>";
				}
			}
		}

    
    pg_close($con);
    ?>
    
</div>
</div>
</body>
</html>
