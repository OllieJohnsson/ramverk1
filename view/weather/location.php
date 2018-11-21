<?php
namespace Anax\View;

var_dump($weather);
// var_dump($weather);

?>

<div class="container-row">
    <div class="info">
        <table>
            <!-- <tr>
                <td>Ip: </td>
                <td nowrap><?= $weather->ip ?></td>
            </tr>
            <tr>
                <td>Typ: </td>
                <td nowrap><?= $weather->type ?></td>
            </tr>
            <tr>
                <td>Domän: </td>
                <td nowrap><?= $weather->host ?></td>
            </tr>
            <tr>
                <td>Land: </td>
                <td nowrap><?= $weather->country_name." ".$weather->country_flag_emoji ?></td>
            </tr>
            <tr>
                <td>Region: </td>
                <td nowrap><?= $weather->region_name ?></td>
            </tr>
            <tr>
                <td>Ort: </td>
                <td nowrap><?= $weather->city ?></td>
            </tr> -->
            <tr>
                <td>Latitud: </td>
                <td nowrap><?= $weather->latitude ?></td>
            </tr>
            <tr>
                <td>Longitud: </td>
                <td nowrap><?= $weather->longitude ?></td>
            </tr>
        </table>
    </div>

    <div class="container-col">
        <iframe style="border: 1px solid #ccc;" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $weather->longitude ?>%2C<?= $weather->latitude ?>%2C<?= $weather->longitude ?>%2C<?= $weather->latitude ?>&amp;layer=mapnik&amp;marker=<?= $weather->latitude ?>%2C<?= $weather->longitude ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?= $weather->latitude ?>&amp;mlon=<?= $weather->longitude ?>#map=18/<?= $weather->latitude ?>/<?= $weather->longitude ?>">Visa större karta</a></small>
    </div>
</div>
