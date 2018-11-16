<?php
namespace Anax\View;

?>

<h1><?= $title ?></h1>

<form class="" action="<?= url($action) ?>" method="post">
    <div class="input-row">
        <input type="text" name="ipAddress" value="<?= $displayIp ?? null?>" autofocus required>
        <button class="button" type="submit" name="button"><?= $buttonTitle ?></button>
    </div>

</form>
