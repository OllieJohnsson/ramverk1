<?php
namespace Anax\View;

// die(var_dump($weather));

// var_dump($weather["timezone"]);
?>


<h1><?= $weather["timezone"] ?></h1>
<div class="container-row">
    <div class="info">
        <table>
            <h3>Översikt <?= $weather["daily"]["icon"] ?></h3>
            <tr>
                <td>Latitud: </td>
                <td nowrap><?= $weather["latitude"] ?></td>
            </tr>
            <tr>
                <td>Longitud: </td>
                <td nowrap><?= $weather["longitude"] ?></td>
            </tr>
            <tr>
                <td>Tidszon: </td>
                <td nowrap><?= $weather["timezone"] ?></td>
            </tr>
        </table>
        <p><?= $weather["daily"]["summary"] ?></p>
    </div>

    <div class="container-col">
        <iframe style="border: 1px solid #ccc;" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $weather["longitude"] ?>%2C<?= $weather["latitude"] ?>%2C<?= $weather["longitude"] ?>%2C<?= $weather["latitude"] ?>&amp;layer=mapnik&amp;marker=<?= $weather["latitude"] ?>%2C<?= $weather["longitude"] ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?= $weather["latitude"] ?>&amp;mlon=<?= $weather["longitude"] ?>#map=18/<?= $weather["latitude"] ?>/<?= $weather["longitude"] ?>">Visa större karta</a></small>
    </div>
</div>

<h3>Prognos</h3>
<div class="container-row" style="overflow: scroll; width: 45rem; margin-bottom: 6rem;">
    <?php foreach ($weather["daily"]["data"] as $day) : ?>
            <div class="info">
                <table>
                    <h3 nowrap><?= date("Y-m-d", $day["time"])." ".$day["icon"] ?></h3>
                    <tr>
                        <td>Högst: </td>
                        <td><?= $day["temperatureHigh"]."°C" ?></td>
                    </tr>
                    <tr>
                        <td>Lägst: </td>
                        <td><?= $day["temperatureLow"]."°C" ?></td>
                    </tr>
                </table>
                <p><?= $day["summary"] ?></p>
            </div>
    <?php endforeach; ?>
</div>
