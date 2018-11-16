<?php
namespace Anax\View;

?>

<div class="container-row">
    <div class="info">
        <table>
            <tr>
                <td>Ip: </td>
                <td nowrap><?= $ipAddress->ip ?></td>
            </tr>
            <tr>
                <td>Typ: </td>
                <td nowrap><?= $ipAddress->type ?></td>
            </tr>
            <tr>
                <td>Domän: </td>
                <td nowrap><?= $ipAddress->host ?></td>
            </tr>
            <tr>
                <td>Land: </td>
                <td nowrap><?= $ipAddress->country_name." ".$ipAddress->country_flag_emoji ?></td>
            </tr>
            <tr>
                <td>Region: </td>
                <td nowrap><?= $ipAddress->region_name ?></td>
            </tr>
            <tr>
                <td>Ort: </td>
                <td nowrap><?= $ipAddress->city ?></td>
            </tr>
            <tr>
                <td>Latitud: </td>
                <td nowrap><?= $ipAddress->latitude ?></td>
            </tr>
            <tr>
                <td>Longitud: </td>
                <td nowrap><?= $ipAddress->longitude ?></td>
            </tr>
        </table>
    </div>

    <div class="container-col">
        <iframe style="border: 1px solid #ccc;" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $ipAddress->longitude ?>%2C<?= $ipAddress->latitude ?>%2C<?= $ipAddress->longitude ?>%2C<?= $ipAddress->latitude ?>&amp;layer=mapnik&amp;marker=<?= $ipAddress->latitude ?>%2C<?= $ipAddress->longitude ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=<?= $ipAddress->latitude ?>&amp;mlon=<?= $ipAddress->longitude ?>#map=18/<?= $ipAddress->latitude ?>/<?= $ipAddress->longitude ?>">Visa större karta</a></small>
    </div>
</div>
