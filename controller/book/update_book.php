<?php
include "../../models/Database.php";
include "../../models/ORM.php";
$db = new DataBase('library');

if ($db->connect()) {
    $orm = new ORM($db);
    $sets = "book_name='{$_POST['book_name']}', book_url='{$_POST['book_url']}',
     author_id={$_POST['author_id']}, book_language='{$_POST['book_language']}',
     category_id={$_POST['category']}, cost={$_POST['cost']}, currency='{$_POST['currency']}',
     book_description='{$_POST['book_description']}'";

    $file_object = $_FILES["book_cover"];
    $image_chosen = isset($file_object) && !empty($file_object["name"]);

    if ($image_chosen) {
        $image_uploaded = $orm->upload_file($file_object);
        $sets = $image_uploaded ? $sets . ", book_cover='{$image_uploaded}'" : $sets;
        if ($image_uploaded)
            $orm->delete_file($_POST['book_cover']);
    }

    $state = $orm->update('book', "book_id={$_POST['book_id']}", $sets);
    $db->close();

    if ($state) {
        header("Location: ../../views/settings.php?view=0&book_id={$_POST['book_id']}&msg='Updated successfully.'");
    } else {
        header("Location: ../../views/settings.php?view=0&book_id={$_POST['book_id']}&msg='Couldn't update.'");
    }
}

$db->close();
die('Server Connection Error');