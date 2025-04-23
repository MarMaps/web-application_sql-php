<?php
print "<html>";
print "<head>";
print "<title>";
print "Добавление авто";
print "</title>";
print "</head>";
print "<body>";

$con = pg_connect('host=localhost port=5432 dbname=prokat_Avto user=postgres password=123');

$marka = trim($_GET['marka']);
$model = trim($_GET['model']);
$god_vypuska = trim($_GET['god_vypuska']);
$moschnost = trim($_GET['moschnost']);
$stoimost_za_chas = trim($_GET['stoimost_za_chas']);

if ($marka != '' && $model != '') {
    print "Марка: ".$marka."<br>";
    print "Модель: ".$model."<br>";
    print "Год выпуска: ".$god_vypuska."<br>";
    print "Мощность: ".$moschnost."<br>";
    print "Стоимость за час: ".$stoimost_za_chas."<br>";

    $sql = "INSERT INTO avtomobili (marka, model, god_vypuska, moschnost, stoimost_za_chas) VALUES ('$marka', '$model', '$god_vypuska', '$moschnost', '$stoimost_za_chas')";
    $result = pg_query($con, $sql);

    if ($result) {
        echo "<p>👍</p>";
    }
}

pg_close($con);

print "</body>";
print "</html>";

?>


