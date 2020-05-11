<?php
    include('connect.php');

    $carrier = $_REQUEST['carrier'];
    $cursor = $collection->find(['carrier'=>$carrier], ['projection'=>['carrier'=>0, '_id'=>0]]);

    foreach ($cursor as $row) {
        $title = $row['title'];
        $date = $row['date'];
        $country = $row['country'];
        $quality = $row['quality'];
        print ("<tr> <td>$title</td> <td>$date</td> <td>$country</td> <td>$quality</td> </tr>");
    }
?>