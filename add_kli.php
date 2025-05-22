<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления кленнта</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Добавление клиента: </h3>
    
    <form method="get" action="">
        <label class="label" for="fio">ФИО</label>
        <input class="area" type="text" name="fio" required> <br>

        <label class="label" for="nomer_telefona">Номер телефона</label>
        <input class="area" type="text" name="nomer_telefona" required> <br>

        <label class="label" for="pasport">Паспорт</label>
        <input class="area" type="text" name="pasport"> <br>

        <input class="btn_dob" name='btn' type='submit' value='Добавить'>
    </form>

    <?php
    function check_kli($pasport, $con)
    {
		$sql = "select fio, nomer_telefona, pasport from klienty";
		$result = pg_query($con, $sql);
		
		$flag = false;
		$j = pg_num_rows($result);
		for ($i = 0; $i < $j; $i++) {
			if ($flag == 1) {
				break;
			}
			$row = pg_fetch_object($result);
			$check_pasp = $row->pasport;
			
			if ($check_pasp == $pasport) {
				$flag = true;
			}
		}
		return $flag;
	
	}
    
    $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
    
    if (isset($_GET['btn'])) {
        $fio = trim($_GET['fio']);
        $nomer_telefona = trim($_GET['nomer_telefona']);
        $pasport = trim($_GET['pasport']);
    
        if ($fio != '' && $nomer_telefona != '') {
			
			if (check_kli($pasport, $con)) {
				print "клиент уже есть в бд";
				exit;
			}
			
            $sql = "INSERT INTO klienty (fio, nomer_telefona, pasport) 
                    VALUES ('$fio', '$nomer_telefona', '$pasport')";
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
