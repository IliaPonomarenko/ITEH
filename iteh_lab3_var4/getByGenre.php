<?php
    include('connect.php');

    $film =  $_REQUEST['genre']; 

    $sth = $dbh->prepare("SELECT film.name, film.date, film.quality, film.producer FROM film, film_genre, genre WHERE genre.title = :film AND fid_genre = id_genre AND fid_film = id_film");
    $sth->bindValue(':film', $film, PDO::PARAM_STR);
    $sth->execute();

    $result = $sth->fetchAll(PDO::FETCH_NUM);
    
    foreach($result as $row){
        $FilmName = $row[0];
        $FilmDate = $row[1];
        $FilmQuality = $row[2];
        $FilmProducer = $row[3];
        print ("<tr> <td>$FilmName</td> <td>$FilmDate</td> <td>$FilmQuality</td> <td>$FilmProducer</td> </tr>");
    }
?>