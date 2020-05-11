<?php
    include('connect.php');
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Изучение расширения PDO</title>
</head>

<body>

<h5>Cписок фильмов выбранного жанра
<form action="getByGenre.php" method="POST">
    <select name="title">
        <?php
            try 
            {
                $sql = 'SELECT title FROM genre';
                foreach ($dbh->query($sql) as $row)
                {
                    $title = $row[0];
                    print "<option value = '$title'>$title</option>";
                }
            }
            catch (PDOExeption $e)
            {
                print "Error!: something wrong with first task" . $e->GetMessage() . "<br/>";
                die(); 
            }
        ?>
        </select>
        <br/><input value="Get" type="submit"/>
</form>
</h5>

<h5>Cписок фильмов с выбранным актером
<form action="getByActor.php" method="POST">
    <select name="name">
        <?php
            try 
            {
                $sql = 'SELECT name FROM actor';
                foreach ($dbh->query($sql) as $row)
                {
                    $name = $row[0];
                    print "<option value = '$name'>$name</option>";
                }
            }
            catch (PDOExeption $e)
            {
                print "Error!: something wrong with second task" . $e->GetMessage() . "<br/>";
                die(); 
            }
        ?>
        </select>
        <br/><input value="Get" type="submit"/>
</form>
</h5>

<h5>Cписок фильмов за указанный временной интервал
<form action="getByDate.php" method="POST">
    <label for="date1">Начиная: </label>
    <input type="date" id="date1" name="date1"/>

    <label for="date2">Заканчивая: </label>
    <input type="date" id="date2" name="date2"/>
    
    <br/><input value="Get" type="submit"/>
</form>
</h5>

</body>
</html>