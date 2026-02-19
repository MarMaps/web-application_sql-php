<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="block-backgr">
<div class="block-form">
    <h3>Регистрация: </h3>
    
    <form method="post" action="">
        <label class="" for="login">Имя пользователя (логин)</label>
        <input class="area" type="text" name="login" required> <br>

        <label class="" for="parol">Пароль</label>
        <input class="area" type="password" name="parol" required> <br>

        <input class="" name='btn' type='submit' value='Зарегистрироваться'>
        
    </form>

    <?php
    $con = pg_connect('host=localhost port=5432 dbname=prokat_avtomobilej user=postgres password=123456');
    
    if (isset($_POST['btn'])) {
        $login = trim($_POST['login']);
        $parol = trim($_POST['parol']);
    
        if ($login != '' && $parol != '') {
			
            $sql = "select * from polzovateli p where p.login = '$login'";
            $res = pg_query($con, $sql);

            if (pg_num_rows($res) > 0) {
                print "<p class='error'>Пользователь с таким логином существует!</p>";
            } else {
                $sql = "insert into polzovateli (login, parol) values ('$login', '$parol')";
                $result = pg_query($con, $sql);
            }
            
            if ($result) {
                print "<p>👍</p>";
                print '<a class="btn-add" href="avtorizaciya.php">На вход</a><br>';
            } else {
                print "<p class='error'>Ошибка при регистрации. Попробуйте еще раз.</p>";
            }
            
            
        }
    }
    
    pg_close($con);
    ?>
</div>    
</div>       
</body>
</html>
