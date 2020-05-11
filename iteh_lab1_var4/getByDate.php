<?php
    include('connect.php');

    $begins = $_POST['date1'];
    $ends = $_POST['date2'];

    $sth = $dbh->prepare("SELECT film.name FROM film WHERE film.date > :begins AND film.date < :ends");
    $sth->bindValue(':begins', $begins, PDO::PARAM_STR);
    $sth->bindValue(':ends', $ends, PDO::PARAM_STR);
    $sth->execute();

    $result = $sth->fetchAll(PDO::FETCH_NUM);
    
    $lenght = count($result);

    echo "<table border='1'>";
    echo "<tr><th>Film</th></tr>";
    
    for ($i = 0; $i < $lenght; $i++) {
       echo "<tr><td>";
       print_r ($result[$i][0]);
       echo "</td></tr>";
    }
    
    echo "</table>";
?>