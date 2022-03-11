<?php

require __DIR__ . "/../vendor/autoload.php";

$db = new \Db\DbAccess();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library</title>

    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

    <script src="script.js" ></script>

</head>
<body>

</div>

<form id="selectByPublisherForm">
    <?php
    $db->viewSelect("publisher");
    ?>
</form>

<form id="selectByDateForm">
    <?php
    $db->viewDate();
    ?>
</form>

<form id="selectByAuthorForm">
    <?php
    $db->viewSelect("author");
    ?>
</form>

<hr>

<div id="results"></div>
</body>
</html>