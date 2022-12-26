<?php
function autoload_models($clase)
{
    require_once "$clase.php";
}

spl_autoload_register('autoload_models');
