<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доб/изм уровня допуска</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="block-backgr">
<div class="block-form">	

    <h3>Доб/изм уровня допуска: </h3>
    
    <form method="get" action="">
        <label class="label" for="login">Выберите пользователя</label>
        <select class="area" name="login" required>
            <option value=""></option>
            <?php
				$con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
				$sql_log = "select id, login from polzovateli";
				$result_log = pg_query($con, $sql_log);
            
				while ($row_log = pg_fetch_assoc($result_log)) {
					print "<option value='{$row_log['id']}'>{$row_log['login']}</option>";
				}
            ?>
        </select><br>
        
        <label class="label" for="new_yd">Укажите новый уровень допуска:</label>
        <input class="area" type="text" name="new_yd" required><br>
        
        <input class="btn_dob" name='btn' type='submit' value='Обновить'>
    </form>

    <?php
		if (isset($_GET['btn'])) {
			$id = $_GET['login'];
			$new_yd = $_GET['new_yd'];

			if ($id != '' && $new_yd != '') {
				//$sql_update = "update polzovateli set yr_dopyska = '$new_yd' where id = '$id'";
				$sql_update = "select add_yr_dop('$id', '$new_yd')";

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
