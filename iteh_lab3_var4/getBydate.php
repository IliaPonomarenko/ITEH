<?php
    header('Content-Type: application/json');

    include('connect.php');

    $begins = $_REQUEST['date1']; 
    $ends = $_REQUEST['date2'];

    $sth = $dbh->prepare("SELECT film.name, film.date, film.quality, film.producer FROM film WHERE film.date > :begins AND film.date < :ends");
    $sth->bindValue(':begins', $begins, PDO::PARAM_STR);
    $sth->bindValue(':ends', $ends, PDO::PARAM_STR);
    $sth->execute();

    $result = $sth->fetchAll(PDO::FETCH_NUM);
    $res = [];
    foreach ($result as $row) {
    
    $NurseName = $row[0];
    $WardName = $row[1];
    $Quality = $row[2];
    $Producer = $row[3];

    $data = array('Nurse' => $NurseName, 'Ward' => $WardName, 'Quality' => $Quality, 'Producer' => $Producer);
    $res[] = $data;
    }
    echo json_encode($res);