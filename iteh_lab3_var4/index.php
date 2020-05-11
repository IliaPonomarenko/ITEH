<?php
    include('connect.php');
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Асинхронный обмен данными с сервером на основе технологии AJAX</title>
    <script>
    
    const ajax = new XMLHttpRequest();
    const xhr = new XMLHttpRequest();
    const json = new XMLHttpRequest();

    function getFirst() {
        let genre = document.getElementById("genre").value;
        ajax.open("GET", "getByGenre.php?genre=" + genre);
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
        let date1 = document.getElementById("date1").value;
        let date2 = document.getElementById("date2").value;
        json.open("GET", "getByDate.php?date1=" + date1 + "&date2=" + date2);
        json.onreadystatechange = update3;
        json.send();
    }

    function update1() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                document.getElementById("resultFirst").innerHTML = ajax.responseText;
            }
        }   
    }

    function update2() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.dir(xhr.responseXML);
                let res = document.getElementById("resultByActor");
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
                res.innerHTML = result;
            }
        }
    }

    function update3() {
        if (json.readyState === 4) {
            if (json.status === 200) {
            console.dir(json.responseText);
            var res = JSON.parse(json.responseText);
            let result3 = "";
            console.dir(res);
                    for (var j = 0; j < res.length; j++){
                        result3 += "<tr>";
                        result3 += "<td>" + res[j].Nurse + "</td>";
                        result3 += "<td>" + res[j].Ward + "</td>";
                        result3 += "<td>" + res[j].Quality + "</td>";
                        result3 += "<td>" + res[j].Producer + "</td>";
                        result3 += "</tr>";
                    }
                document.getElementById("resultByDate").innerHTML = result3;
            }
        }
    }

</script>
</head>

<body>

<h5>Cписок фильмов выбранного жанра
<select name="genre" id="genre">
    <?php
        try 
        {
            $sql = 'SELECT title FROM genre';
            foreach ($dbh->query($sql) as $row)
            {
                $title = $row[0];
                print "<option value = '$title'>$title</option>";
            }
        }
        catch (PDOExeption $e)
        {
            print "Error!: something wrong with first task" . $e->GetMessage() . "<br/>";
            die(); 
        }
        ?>
    </select>
    <br/><input value="Get" type="button" onclick="getFirst()">

</h5>

<table border = "1">
    <thead>
        <tr>
            <th>Название</th>
            <th>Дата</th>
            <th>Качество</th>
            <th>Продюсер</th>
        </tr>
    </thead>
    <tbody id="resultFirst">
    </tbody>
</table>

<h5>Cписок фильмов с выбранным актером
    <select name="actor" id="actor">
        <?php
            try 
            {
                $sql = 'SELECT name FROM actor';
                foreach ($dbh->query($sql) as $row)
                {
                    $name = $row[0];
                    print "<option value = '$name'>$name</option>";
                }
            }
            catch (PDOExeption $e)
            {
                print "Error!: something wrong with second task" . $e->GetMessage() . "<br/>";
                die(); 
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
            <th>Качество</th>
            <th>Продюсер</th>
        </tr>
    </thead>
    <tbody id="resultByActor">
    </tbody>
</table>

<h5>Cписок фильмов за указанный временной интервал
    <label for="date1">Начиная: </label>
    <input type="date" id="date1" name="date1"/>

    <label for="date2">Заканчивая: </label>
    <input type="date" id="date2" name="date2"/>
    
    <br/><input value="Get" type="submit" onclick="getByDate()"/>
</h5>

<table border = "1">
    <thead>
        <tr>
            <th>Название</th>
            <th>Дата</th>
            <th>Качество</th>
            <th>Продюсер</th>
        </tr>
    </thead>
    <tbody id="resultByDate">
    </tbody>
</table>

</body>
</html>