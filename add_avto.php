<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления авто</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Добавление авто: </h3>
    
    <form method="get" action="">
        <label class="label" for="marka">Марка</label>
        <input class="area" type="text" name="marka" required> <br>

        <label class="label" for="model">Модель</label>
        <input class="area" type="text" name="model" required> <br>

        <label class="label" for="god_vypuska">Год выпуска</label>
        <input class="area" type="text" name="god_vypuska"> <br>

        <label class="label" for="moschnost">Мощность</label>
        <input class="area" type="text" name="moschnost"> <br>

        <label class="label" for="stoimost_za_chas">Стоимость за час</label>
        <input class="area" type="text" name="stoimost_za_chas"> <br>
        
        <label class="label" for="gos_nomer">Гос. номер</label>
        <input class="area" type="text" name="gos_nomer"> <br>

        <input class="btn_dob" name='btn' type='submit' value='Добавить'>
    </form>

    <?php
    $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
    
    if (isset($_GET['btn'])) {
        $marka = trim($_GET['marka']);
        $model = trim($_GET['model']);
        $god_vypuska = trim($_GET['god_vypuska']);
        $moschnost = trim($_GET['moschnost']);
        $stoimost_za_chas = trim($_GET['stoimost_za_chas']);
		$gos_nomer = trim($_GET['gos_nomer']);
    
        if ($marka != '' && $model != '') {
            $sql = "INSERT INTO avtomobili (marka, model, god_vypuska, moschnost, stoimost_za_chas, gos_nomer) 
                    VALUES ('$marka', '$model', '$god_vypuska', '$moschnost', '$stoimost_za_chas', '$gos_nomer')";
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
