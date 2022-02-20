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

</head>
<body>

<?php
echo \Db\DbAccess::$fosrmStart;
$db->viewSelect("publisher");
echo \Db\DbAccess::$formEnd;

echo \Db\DbAccess::$fosrmStart;
$db->viewDate();
echo \Db\DbAccess::$formEnd;

echo \Db\DbAccess::$fosrmStart;
$db->viewSelect("author");
echo \Db\DbAccess::$formEnd;
?>

<hr>
<?php
if (isset($_POST)) {
$db->chooseRequest($_POST);
}
?>
</body>
</html>
