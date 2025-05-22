<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Отчет заказов с выбором даты: </h3>
    
    <form method="get" action="">
        <label>Дата: с </label>
        <input type="date" name="data1" required> 
        <span>по</span>
        <input type="date" name="data2" required> <br><br>
        <input class="btn_dob" name="btn" type="submit" value="Показать">
    </form>
    <br> 

    <?php
    error_reporting(0);

    if (isset($_GET['btn'])) {
        $data1 = $_GET['data1'];
        $data2 = $_GET['data2'];

        if ($data1 != '' && $data2 != '') {
            $con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');

            $sql = "select zakazy.id, avtomobili.marka, zakazy.id_avto, klienty.fio, zakazy.data, zakazy.data_vozvrata, zakazy.status 
                    from zakazy
                    inner join avtomobili on zakazy.id_avto = avtomobili.id
                    inner join klienty on zakazy.id_klienta = klienty.id
                    where zakazy.data between '$data1' and '$data2'
                    order by zakazy.data";

            $result = pg_query($con, $sql);
            $n = pg_num_rows($result);

            if ($n > 0) {
                print "<h4>Заказы с $data1 по $data2:</h4>";
                print "<table class='table_ot' border='7' cellpadding='5'>
                        <tr>
                            <th>ID</th>
                            <th>Авто (ID)</th>
                            <th>Клиент</th>
                            <th>Дата</th>
                            <th>Дата возврата</th>
                            <th>Статус</th>
                        </tr>";

                for ($i = 0; $i < $n; $i++) {
                    $row = pg_fetch_object($result);
                    print "<tr>
                            <td><b>$row->id</b></td>
                            <td>$row->marka ($row->id_avto)</td>
                            <td>$row->fio</td>
                            <td>$row->data</td>
                            <td>$row->data_vozvrata</td>
                            <td>$row->status</td>
                        </tr>";
                }
                print "</table>";
            } else {
                print "<p><b>Заказов на период этой даты не было</b></p>";
            }

            pg_close($con);
        }
    }
    ?>
</body>
</html>
