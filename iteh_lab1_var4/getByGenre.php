<?php
    include('connect.php');

    $film = $_POST['title']; 

    $sth = $dbh->prepare("SELECT film.name FROM film, film_genre, genre WHERE genre.title = :film AND fid_genre = id_genre AND fid_film = id_film");
    $sth->bindValue(':film', $film, PDO::PARAM_STR);
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