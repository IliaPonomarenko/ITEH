<?php
    include('connect.php');
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>MongoDB</title>
    <script>
    
    const ajax = new XMLHttpRequest();
    const xhr = new XMLHttpRequest();
    const json = new XMLHttpRequest();

    function getVideo() {
        ajax.open("GET", "getByVideo.php?carrier=video");
        ajax.onreadystatechange = update1;
        ajax.send(); 
    }

    function getByActor() {
        let actor = document.getElementById("actor").value;
        xhr.open("GET", "getByActor.php?actor=" + actor);
        xhr.onreadystatechange = update2;
        xhr.send();
    }

    function getByDate() {
        json.open("GET", "getByDate.php?date=2020");
        json.onreadystatechange = update3;
        json.send();
    }

    function update1() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {

                localStorage['video'] = ajax.responseText;

                document.getElementById("resultFirst").innerHTML = ajax.responseText;
            }
            else{
                if( localStorage['video'] !== undefined){
                    document.getElementById("resultFirst").innerHTML = localStorage['video'];
                }
            }
        }   
    }

    function update2() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                let table = document.getElementById("resultByActor");
                let res = document.getElementById("actor");
                let result = "";
                let rows = xhr.responseXML.firstChild.children;
                    for (var i = 0; i < rows.length; i++){
                        result += "<tr>";
                        result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                        result += "<td>" + rows[i].children[1].textContent + "</td>";
                        result += "<td>" + rows[i].children[2].textContent + "</td>";
                        result += "<td>" + rows[i].children[3].textContent + "</td>";
                        result += "</tr>";
                    }
                localStorage[res] = result;
                table.innerHTML = result;
            }
            else{
                let res = document.getElementById("actor");
                if( localStorage[res] !== undefined){
                    document.getElementById("resultByActor").innerHTML = localStorage[res];
                }
            }
        }
    }

    function update3() {
        if (json.readyState === 4) {
            if (json.status === 200) {
                let date = document.getElementById("date");
                var res = JSON.parse(json.responseText);
                let result3 = "";
                for (var j = 0; j < res.length; j++){
                    result3 += "<tr>";
                    result3 += "<td>" + res[j].title + "</td>";
                    result3 += "<td>" + res[j].produser + "</td>";
                    result3 += "<td>" + res[j].country + "</td>";
                    result3 += "<td>" + res[j].quality + "</td>";
                    result3 += "</tr>";
                }
                localStorage[date] = result3;
                document.getElementById("resultByDate").innerHTML = result3;
            }
            else{
                let res = document.getElementById("date");
                if( localStorage[res] !== undefined){
                    document.getElementById("resultByDate").innerHTML = localStorage[res];
                }
            }
        }
    }

</script>
</head>

<body>

<h5>Cписок фильмов с выбранным актером
    <select name="actor" id="actor">
        <?php
            $cursor = $collection->distinct('actor');
            foreach ($cursor as $row)
            {
                $actor = $row;
                print "<option value = '$actor'>$actor</option>";
            }
            ?>
        </select>
        <br/><input value="Get" type="submit" onclick="getByActor()"/>
</form>
</h5>

<table border = "1">
    <thead>
        <tr>
            <th>Название</th>
            <th>Дата</th>
            <th>Страна</th>
            <th>Качество</th>
        </tr>
    </thead>
    <tbody id="resultByActor">
    </tbody>
</table>

<h5>Что посмотреть на касетах
    <br/><input value="Get" type="button" onclick="getVideo()">
</h5>

<table border = "1">
    <thead>
        <tr>
            <th>Название</th>
            <th>Дата</th>
            <th>Страна</th>
            <th>Качество</th>
        </tr>
    </thead>
    <tbody id="resultFirst">
    </tbody>
</table>

<h5>Что посмотреть из нового (вышедшее в этом году)
    <br/><input value="Get" type="submit" onclick="getByDate()"/>
</h5>

<table border = "1">
    <thead>
        <tr>
            <th>Название</th>
            <th>Продюсер</th>
            <th>Страна</th>
            <th>Качество</th>
        </tr>
    </thead>
    <tbody id="resultByDate">
    </tbody>
</table>

</body>
</html>