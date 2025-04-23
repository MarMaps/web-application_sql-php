<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>форма доб авто</title>
</head>
<body>
    
    <h3>Добавление авто: </h3>
    
    <form method="get" action="z_dob_avto.php">
        <label for="marka">Марка</label>
        <input type="text" name="marka"> <br>

        <label for="model">Модель</label>
        <input type="text" name="model"> <br>

        <label for="god_vypuska">Год выпуска</label>
        <input type="text" name="god_vypuska"> <br>

        <label for="moschnost">Мощность</label>
        <input type="text" name="moschnost"> <br>

        <label for="stoimost_za_chas">Стоимость за час</label>
        <input type="text" name="stoimost_za_chas"> <br>

        

        <input name='btn' type='submit' value='Добавить'>
    </form>

    <br> <a href="main.php">на главную</a>
</body>
</html>