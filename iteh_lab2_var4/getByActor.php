<?php
    include('connect.php');

    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");

    $actor = $_REQUEST['actor'];
    $cursor = $collection->find(['actor'=>$actor], ['projection'=>['actor'=>0, '_id'=>0]]);
    
    echo '<?xml version="1.0" encoding="utf-8" ?>';
    echo "<root>";

    foreach ($cursor as $row) {
        $title = $row['title'];
        $date = $row['date'];
        $country = $row['country'];
        $quality = $row['quality'];
        print "<row><title>$title</title> <date>$date</date> <country>$country</country> <quality>$quality</quality></row>";
    }

    echo "</root>";
?>