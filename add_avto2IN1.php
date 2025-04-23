<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления авто</title>
</head>
<body>
    <h3>Добавление авто: </h3>
    
    <form method="get" action="">
        <label for="marka">Марка</label>
        <input type="text" name="marka" required> <br>

        <label for="model">Модель</label>
        <input type="text" name="model" required> <br>

        <label for="god_vypuska">Год выпуска</label>
        <input type="text" name="god_vypuska"> <br>

        <label for="moschnost">Мощность</label>
        <input type="text" name="moschnost"> <br>

        <label for="stoimost_za_chas">Стоимость за час</label>
        <input type="text" name="stoimost_za_chas"> <br>

        <input name='btn' type='submit' value='Добавить'>
    </form>

    <br> <a href="main.php">На главную</a>

    <?php
    $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
    
    if (isset($_GET['btn'])) {
        $marka = trim($_GET['marka']);
        $model = trim($_GET['model']);
        $god_vypuska = trim($_GET['god_vypuska']);
        $moschnost = trim($_GET['moschnost']);
        $stoimost_za_chas = trim($_GET['stoimost_za_chas']);
    
        if ($marka != '' && $model != '') {
            $sql = "INSERT INTO avtomobili (marka, model, god_vypuska, moschnost, stoimost_za_chas) 
                    VALUES ('$marka', '$model', '$god_vypuska', '$moschnost', '$stoimost_za_chas')";
            $result = pg_query($con, $sql);
    
            if ($result) {
                echo "<p>👍</p>";
            }
        }
    }
    
    pg_close($con);
    
    ?>
</body>
</html>