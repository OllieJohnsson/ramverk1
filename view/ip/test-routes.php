<?php
namespace Anax\View;

?>

<p>Skicka in en IP-adress och du får ett svar i JSON-format.</p>

<p>Här finns några exempel-länkar:</p>

<a href="<?= url($route."/rest-api/ip/216.58.207.206") ?>">
    <?= $route ?>/rest-api/ip/216.58.207.206
</a>
<br>
<a href="<?= url($route."/rest-api/ip/74.125.206.106") ?>">
    <?= $route ?>/rest-api/ip/74.125.206.106
</a>
<br>
<a href="<?= url($route."/rest-api/ip/0:0:0:0:0:ffff:d83a:cfce") ?>">
    <?= $route ?>/rest-api/ip/0:0:0:0:0:ffff:d83a:cfce
</a>
