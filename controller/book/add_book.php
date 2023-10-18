<?php
include "../../models/Database.php";
include "../../models/ORM.php";
$db = new DataBase('library');

if ($db->connect()) {
    $orm = new ORM($db);

    $file_object = $_FILES["book_cover"];
    $image_chosen = isset($file_object) && !empty($file_object["name"]);

    if ($image_chosen) {
        $image_uploaded = $orm->upload_file($file_object);
        $state = $image_uploaded ? $orm->insert('book', "(NULL, '{$_POST['book_name']}', {$_POST['cost']},
         '{$image_uploaded}', '{$_POST['book_url']}', '{$_POST['book_description']}', '{$_POST['currency']}',
         '{$_POST['book_language']}', {$_POST['author_id']}, {$_POST['category']})") : $image_uploaded;
        $db->close();

        if ($state) {
            header("Location: ../../index.php?msg='Book added successfully.'");
        } else {
            header("Location: ../../views/settings.php?msg='Couldn\'t add book.'");
        }
    }
}

$db->close();
die('Server Connection Error');