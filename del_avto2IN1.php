<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаления авто</title>
</head>
<body>
    <h3>Удаления авто: </h3>
    <form method="get" action="">
        <label for="marka">Марка</label>
        <input type="text" name="marka"> <br>

        <label for="model">Модель</label>
        <input type="text" name="model"> <br>

        <input name='btn' type='submit' value='Удалить'>
    </form>
    <br> <a href="main.php">На главную</a>

    <?php
    $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');
    
    if (isset($_GET['btn'])) {
        $marka = trim($_GET['marka']);
        $model = trim($_GET['model']);
        if ($marka != '' && $model != '') {
            $sql = "DELETE FROM avtomobili WHERE marka='$marka' AND model='$model'";
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

<!-- При удалении авто, которое ссылается на заказы или нешт сит -> Warning: pg_query(): Query failed: ОШИБКА: UPDATE или DELETE в таблице "avtomobili" нарушает ограничение внешнего ключа "zakazy_avtomobili_fk" таблицы "zakazy" DETAIL: На ключ (id)=(1) всё ещё есть ссылки в таблице "zakazy". in C:\xampp\htdocs\bd\del_avto2IN1.php on line 33 -->