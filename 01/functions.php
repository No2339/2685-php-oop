<?php

function dd($item, $die = true)
{
    echo '<pre>';
    var_dump($item);
    echo '</pre>';

    if ($die)
        die();
}
 
