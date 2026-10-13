<?php
require_once 'config.php';

function clean($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
