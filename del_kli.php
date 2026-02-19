<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление клиента</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Удаление клиента: </h3>
    <form method="get" action="">
        <label class="label_del" for="pasport">Введите паспорт</label>
        <input class="area" type="text" name="pasport"> <br>


        <input class="btn_dob" name='btn' type='submit' value='Удалить'>
    </form>

    <?php
    $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
    
    if (isset($_GET['btn'])) {
        $pasport = trim($_GET['pasport']);
        if ($pasport != '') {
            $sql = "delete from klienty where pasport='$pasport'";
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


