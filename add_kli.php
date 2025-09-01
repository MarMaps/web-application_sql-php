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
    
    $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
    
    if (isset($_GET['btn'])) {
        $fio = trim($_GET['fio']);
        $nomer_telefona = trim($_GET['nomer_telefona']);
        $pasport = trim($_GET['pasport']);
    
        if ($fio != '' && $nomer_telefona != '') {
			
           $sql = "insert into klienty (fio, nomer_telefona, pasport) 
                    values ('$fio', '$nomer_telefona', '$pasport')";
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
