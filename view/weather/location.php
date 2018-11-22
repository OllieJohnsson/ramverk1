<?php
namespace Anax\View;

// echo "<pre>";
// var_dump($weather);
// echo "------";
// echo $weather->currently->windSpeed;
// var_dump($weather);

// var_dump($weather->daily->data[0]);
// var_dump($weather->daily->data);

?>

<?php foreach ($weather->daily->data as $key => $day): ?>
    <p>Dag <?= $key ?></p>
    <p><?= $day->temperatureHigh ?></p>
    <br>
<?php endforeach; ?>

<div class="container-row">




    <div class="info">
        <table>
            <h3>Vädret just nu</h3>
            <tr>
                <td>Latitud: </td>
                <td nowrap><?= $weather->latitude ?></td>
            </tr>
            <tr>
                <td>Longitud: </td>
                <td nowrap><?= $weather->longitude ?></td>
            </tr>
            <tr>
                <td>Temperatur: </td>
                <td nowrap><?= $weather->currently->temperature ?>°C</td>
            </tr>
            <tr>
                <td>Summering: </td>
                <td nowrap><?= $weather->currently->summary ?></td>
            </tr>
            <tr>
                <td>Ikon: </td>
                <td nowrap><?= $weather->currently->icon ?></td>
            </tr>
        </table>
    </div>

    <div class="container-col">
        <iframe style="border: 1px solid #ccc;" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $weather->longitude ?>%2C<?= $weather->latitude ?>%2C<?= $weather->longitude ?>%2C<?= $weather->latitude ?>&amp;layer=mapnik&amp;marker=<?= $weather->latitude ?>%2C<?= $weather->longitude ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?= $weather->latitude ?>&amp;mlon=<?= $weather->longitude ?>#map=18/<?= $weather->latitude ?>/<?= $weather->longitude ?>">Visa större karta</a></small>
    </div>
</div>
