<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления нештатных ситуаций</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Добавление нештатных ситуаций: </h3>
    
    <form method="get" action="">
        <label class="label" for="id_zakaza">Заказ(№):</label>
        <select class="area" name="id_zakaza" required>
            <option value=""></option>
            <?php
            $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
            $sql_zakaz = "select id from zakazy";
            $result_zakaz = pg_query($con, $sql_zakaz);
            
            while ($row_zakaz = pg_fetch_assoc($result_zakaz)) {
                print "<option value='{$row_zakaz['id']}'>{$row_zakaz['id']}</option>";
            }
            ?>
        </select><br>

        <label class="label" for="opisanie">Описание:</label>
        <input class="area" type="text" name="opisanie" required><br>

        <label class="label" for="summa_shtrafa">Сумма штрафа:</label>
        <input class="area" type="text" name="summa_shtrafa" required><br>
        
        <input class="btn_dob" name='btn' type='submit' value='Добавить'>
    </form>

    <?php
    if (isset($_GET['btn'])) {
        $id_zakaza = trim($_GET['id_zakaza']);
        $opisanie = trim($_GET['opisanie']);
        $summa_shtrafa = trim($_GET['summa_shtrafa']);
        
        if ($opisanie != '' && $summa_shtrafa != '') {
            $sql = "insert into neshtatnye_situacii (id_zakaza, opisanie, summa_shtrafa) 
                    values ('$id_zakaza', '$opisanie', '$summa_shtrafa')";
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
