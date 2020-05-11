<?php
    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");

    include('connect.php');

    $actor =  $_REQUEST['actor']; 

    $sth = $dbh->prepare("SELECT film.name, film.date, film.quality, film.producer FROM  film, film_actor, actor WHERE actor.name = :actor AND fid_actor = id_actor AND fid_film = id_film");
    $sth->bindValue(':actor', $actor, PDO::PARAM_STR);
    $sth->execute();

    $result = $sth->fetchAll(PDO::FETCH_NUM);
    
    echo '<?xml version="1.0" encoding="utf-8" ?>';
    echo "<root>";

    foreach ($result as $row) {
        $NurseName = $row[0];
        $WardName = $row[1];
        $Date = $row[2];
        $Department = $row[3];
        print "<row><NurseName>$NurseName</NurseName> <WardName>$WardName</WardName> <Date>$Date</Date> <Department>$Department</Department></row>";
    }
    echo "</root>";
?>