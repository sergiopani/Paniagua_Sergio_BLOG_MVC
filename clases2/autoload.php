<?php
function autoload_clases($clase)
{
    require_once "$clase.php";
}

spl_autoload_register('autoload_clases');
