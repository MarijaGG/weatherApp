<?php
$data = file_get_contents("https://emo.lv/weather-api/forecast/?city=riga,latvia");
$weather = json_decode($data, true);

$city = $weather['city']['name'] ?? 'Unknown';
$current = $weather['list'][0];

$sunrise = date("H:i A", $current['sunrise']);
$sunset  = date("H:i A", $current['sunset']);
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Laika ziņas – <?php echo htmlspecialchars($city); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Laika ziņas: <?php echo htmlspecialchars($city); ?></h1>
    </header>

    <main class="layout">
        <aside class="left">
            <section class="current">
                <h2>Pašreizējais laiks</h2>
                <p><strong>Laikapstākļi:</strong> <?php echo htmlspecialchars($weather['list'][0]['weather'][0]['description']); ?></p>
                <p><strong>Temperatūra:</strong> <?php echo $current['temp']['day']; ?>°C</p>
                <p><strong>Jūtas kā:</strong> <?php echo $current['feels_like']['day']; ?>°C</p>
                <p><strong>Mākoņainība:</strong> <?php echo $current['clouds']; ?>%</p>
                <p><strong>Mitrums:</strong> <?php echo $current['humidity']; ?>%</p>
                <p><strong>Spiediens:</strong> <?php echo $current['pressure']; ?> hPa</p>
                <p><strong>Vējš:</strong> <?php echo $current['speed']; ?> m/s</p>
            </section>

            <section class="sun">
                <h2>Saules informācija</h2>
                <p><strong>Saullēkts:</strong> <?php echo $sunrise; ?></p>
                <p><strong>Saulriets:</strong> <?php echo $sunset; ?></p>
            </section>
        </aside>

        <section class="right">
            <h2>Prognoze (nākamās dienas)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Datums</th>
                        <th>Temperatūra (dienā)</th>
                        <th>Laiks</th>
                        <th>Mitrums</th>
                        <th>Vējš</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach (array_slice($weather['list'], 1, 11) as $day): ?>
                     <tr>
                        <td><?php echo date('d.m.Y', $day['dt']); ?></td>
                        <td><?php echo $day['temp']['day']; ?>°C</td>
                        <td><?php echo htmlspecialchars($day['weather'][0]['description']); ?></td>
                        <td><?php echo $day['humidity']; ?>%</td>
                        <td><?php echo $day['speed']; ?> m/s</td>
                     </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>


</body>
</html>