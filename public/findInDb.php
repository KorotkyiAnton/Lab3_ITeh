<?php

require __DIR__ . "/../vendor/autoload.php";

$db = new \Db\DbAccess();

if (isset($_POST)) {
    echo $db->chooseRequest($_POST);
}
