
<h1><?= $weather[0]["timezone"] ?></h1>
<div class="container-row">
    <div class="container-col">
        <iframe style="border: 1px solid #ccc;" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $weather[0]["longitude"] ?>%2C<?= $weather[0]["latitude"] ?>%2C<?= $weather[0]["longitude"] ?>%2C<?= $weather[0]["latitude"] ?>&amp;layer=mapnik&amp;marker=<?= $weather[0]["latitude"] ?>%2C<?= $weather[0]["longitude"] ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?= $weather[0]["latitude"] ?>&amp;mlon=<?= $weather[0]["longitude"] ?>#map=18/<?= $weather[0]["latitude"] ?>/<?= $weather[0]["longitude"] ?>">Visa större karta</a></small>
    </div>
</div>

<h3>Historik</h3>
<div class="container-row" style="overflow: scroll; width: 45rem; margin-bottom: 6rem;">
    <?php foreach ($weather as $day) : ?>
            <div class="info">
                <table>
                    <h3 nowrap><?= date("Y-m-d", $day["daily"]["data"][0]["time"])." ".$day["daily"]["data"][0]["icon"] ?></h3>
                    <tr>
                        <td>Högst: </td>
                        <td><?= $day["daily"]["data"][0]["temperatureHigh"]."°C" ?></td>
                    </tr>
                    <tr>
                        <td>Lägst: </td>
                        <td><?= $day["daily"]["data"][0]["temperatureLow"]."°C" ?></td>
                    </tr>
                </table>
                <p><?= $day["daily"]["data"][0]["summary"] ?></p>
            </div>
    <?php endforeach; ?>
</div>
