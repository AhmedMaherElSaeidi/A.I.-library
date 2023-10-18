<?php
include "../../models/Database.php";
include "../../models/ORM.php";
$db = new DataBase('library');

if ($db->connect()) {
    $orm = new ORM($db);

    $url = $_POST['url'];
    $book_id = $_POST['submit'];
    $user_id = $_POST['user_id'];

    $orm->insert("cart", "(NULL, '{$book_id}', '{$user_id}')");
    $db->close();

    header('Location: ../../' . $url . '.php');
}

$db->close();
die('Server Connection Error');