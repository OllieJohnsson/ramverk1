<?php
namespace Anax\View;

?>

<h1><?= $title ?></h1>

<form class="" action="<?= url($action) ?>" method="post">
    <input type="text" name="ipAddress" value="" autofocus required>
    <button class="button" type="submit" name="button">Validera</button>
</form>
