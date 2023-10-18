<?php
include "../../models/Database.php";
include "../../models/ORM.php";
$db = new DataBase('library');

if ($db->connect()) {
    $orm = new ORM($db);
    $url = $_GET['url'];
    $book_id = $_GET['book_id'];
    $book_cover = $_GET['book_cover'];

    $orm->delete('book', "book_id={$book_id}");
    $orm->delete_file($book_cover);

    $db->close();
    header("Location: ../../{$url}.php?msg='Book removed.'");
}

$db->close();
die('Server Connection Error');