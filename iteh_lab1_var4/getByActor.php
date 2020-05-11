<?php
    include('connect.php');

    $actor = $_POST['name']; 

    $sth = $dbh->prepare("SELECT film.name FROM film, film_actor, actor WHERE actor.name = :actor AND fid_actor = id_actor AND fid_film = id_film");
    $sth->bindValue(':actor', $actor, PDO::PARAM_STR);
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