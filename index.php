<?php 


$data = file_get_contents("https://emo.lv/weather-api/forecast/?city=cesis,latvia");
$weather = json_decode($data, true);

?>
<html>
<body>

<p>Pilsēta: <?php echo $weather['city']['name']; ?></p>

<p>Temperatūra: <?php echo $weather['list'][0]['temp']['day']; ?>°C<br>
   Feels like: <?php echo $weather['list'][0]['feels_like']['day']; ?>°C</p>


</body>
</html>