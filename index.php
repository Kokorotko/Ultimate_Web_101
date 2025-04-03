<?php
    session_start();    
    if (!isset($_SESSION['user_id'])) header("Location: login.php");
    require_once("Db.php");
    Db::connect('sql5.webzdarma.cz', 'kamilfranekw6956', 'kamilfranekw6956', 'QLlF4@g#5#&kCc%F)$@7');
    $API = 'f37cb74987b69231d25fcc5d4bba75f4';
    $data = null;
    //City
    if (isset($_POST['inputType']))
    {        
        if ($_POST['inputType'] == "city")
        {
            if (isset($_POST['city']) && $_POST['city'] != null) 
            {                
                $data = file_get_contents("http://api.openweathermap.org/geo/1.0/direct?q=".$_POST['city']."&limit=1&appid=".$API."&units=metric"); //get content
                $data = json_decode($data);
            }    
            else echo "Problem with City input.";
        }
        else if ($_POST['inputType'] == "lat")
        {
            if (isset($_POST['lat']) && is_numeric($_POST['lat']) && $_POST['lat'] <= 90 && $_POST['lat'] >= -90)            
            {
                if (isset($_POST['lon']) && is_numeric($_POST['lon']) && $_POST['lon'] <= 180 && $_POST['lon'] >= -180)
                {
                    $part = 0;
                    $data = file_get_contents('https://api.openweathermap.org/data/3.0/onecall?lat='.$lat.'&lon='.$lon."&exclude=".$part."&appid=".$API."&units=metric"); //get content
                    $data = json_decode($data);
                }
                else echo "Problem with LON input.";
            }
            else echo "Problem with LAT input.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yes</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    
</script>

    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript">
        google.charts.load('current', {'packages': ["corechart"]});
        google.charts.setOnLoadCallback(drawChart1);
        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Čas', 'Vlhkost'],
                <?php foreach ($database as $once) echo "['" . $once['time'] . "', " . $once['vlhkost_venek'] . "],"; ?>
            ]);
            var options = { title: 'Venkovni vlhkost', curveType: 'function', legend: {position: 'bottom'} };
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1>Ultimate Weather Thing</h1>
    <div class="logoff">        
        <form action="logout.php" method='get'>
            <input type="submit" value="Log Out">
        </form>
    </div>
    <form action="#" method='post'>
        <label for="text">City name:</label><br>
        <input type="text" required name="city">
        <input type="hidden" name="inputType" value="city">
        <input type="submit" value="submit">
    </form>
    <br><br>
    <form action="#" method='post'>
        <label for="lat">Lat:</label><br>
        <input type="text" required name="lat"><br>
        <label for="lat">Lon:</label><br>
        <input type="text" required name="lon">
        <input type="hidden" name="inputType" value="lat">
        <input type="submit" name="submit">
    </form>
    
</body>
</html>
