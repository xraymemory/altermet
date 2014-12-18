<?php

$db_loc = 'test.db';

$db = new SQLite3($db_loc);

$statement = $db->prepare('INSERT INTO altermet (id, text, x, y, date) values(null, :text, :x, :y, :date)');
$statement->bindValue(':text', $_POST['text']);
$statement->bindValue(':x', $_POST['x']);
$statement->bindValue(':y', $_POST['y']);
$statement->bindValue(':date', $_POST['date']);

$result = $statement->execute();

?>