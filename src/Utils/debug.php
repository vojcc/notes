<?php
declare(strict_types = 1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

function dump($data) {
    echo '<br><div style="
        background: lightblue;
        display: inline-block;
        border: 1px solid gray;
        padding: 0 10px;
    "><pre>';

    print_r($data);
    echo '</pre></div><br>';
}
