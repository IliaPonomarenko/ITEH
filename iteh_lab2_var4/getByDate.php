<?php
    header('Content-Type: application/json');

    include('connect.php');

    $date = $_REQUEST['date']; 

    $cursor = $collection->find(['date'=>$date], ['projection'=>['date'=>0, '_id'=>0]]);

    $res = [];
    foreach ($cursor as $row) {
        $title = $row['title'];
        $produser = $row['produser'];
        $country = $row['country'];
        $quality = $row['quality'];

    $data = array('title' => $title, 'produser' => $produser, 'country' => $country, 'quality' => $quality);
    $res[] = $data;
    }
    echo json_encode($res);