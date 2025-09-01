<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление авто</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Удаление авто: </h3>
    <form method="get" action="">
        <label class="label_del" for="marka">Введите гос. номер</label>
        <input class="area" type="text" name="gos_nomer"> <br>


        <input class="btn_dob" name='btn' type='submit' value='Удалить'>
    </form>

    <?php
    $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
    
    if (isset($_GET['btn'])) {
        $gos_nomer = trim($_GET['gos_nomer']);
        if ($gos_nomer != '') {
            $sql = "delete from avtomobili where gos_nomer='$gos_nomer'";
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
