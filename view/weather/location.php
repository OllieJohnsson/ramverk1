<?php
namespace Anax\View;

// var_dump($weather[0]);
?>

<?php foreach ($weather as $location): ?>
    <h1><?= $location->timezone ?></h1>
    <div class="container-row">
        <div class="info">
            <table>
                <h3>Översikt <?= $location->daily->icon ?></h3>
                <tr>
                    <td>Latitud: </td>
                    <td nowrap><?= $location->latitude ?></td>
                </tr>
                <tr>
                    <td>Longitud: </td>
                    <td nowrap><?= $location->longitude ?></td>
                </tr>
                <tr>
                    <td>Tidszon: </td>
                    <td nowrap><?= $location->timezone ?></td>
                </tr>
            </table>
            <p><?= $location->daily->summary ?></p>
        </div>

        <div class="container-col">
            <iframe style="border: 1px solid #ccc;" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $location->longitude ?>%2C<?= $location->latitude ?>%2C<?= $location->longitude ?>%2C<?= $location->latitude ?>&amp;layer=mapnik&amp;marker=<?= $location->latitude ?>%2C<?= $location->longitude ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?= $location->latitude ?>&amp;mlon=<?= $location->longitude ?>#map=18/<?= $location->latitude ?>/<?= $location->longitude ?>">Visa större karta</a></small>
        </div>
    </div>

    <h3>Prognos</h3>
    <div class="container-row" style="overflow: scroll; width: 45rem; margin-bottom: 6rem;">
        <?php foreach ($location->daily->data as $day): ?>
                <div class="info">
                    <table>
                        <h3 nowrap><?= date("Y-m-d", $day->time)." ".$day->icon ?></h3>
                        <tr>
                            <td>Högst: </td>
                            <td><?= $day->temperatureHigh."°C" ?></td>
                        </tr>
                        <tr>
                            <td>Lägst: </td>
                            <td><?= $day->temperatureLow."°C" ?></td>
                        </tr>
                    </table>
                    <p><?= $day->summary ?></p>
                </div>
        <?php endforeach; ?>
    </div>

    <div class="container-row">

    </div>


<?php endforeach; ?>
