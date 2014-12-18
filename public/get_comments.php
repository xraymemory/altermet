<?php

$db_loc = 'test.db';

$db = new SQLite3($db_loc);

$id = $_POST['id'];
$results = $db->query("select * from altermet where id >= $id");

$stack = array();
while ($row = $results->fetchArray($mode = SQLITE3_ASSOC))
    { 
        $buffer = array(
            'id' => $row['id'],
            'text' => $row['text'],
            'x' => $row['x'],
            'y' => $row['y']);
        array_push($stack, $buffer);
    }
$json_string = json_encode($stack);
echo $json_string;

die();
?>