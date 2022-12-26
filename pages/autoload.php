<?php
function autoload($clase){
    require_once "../pages/$clase" . "php";    
}

spl_autoload_register('autoload');