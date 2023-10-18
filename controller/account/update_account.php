<?php
include "../../models/Database.php";
include "../../models/ORM.php";
$db = new DataBase('library');

session_start();
$_SESSION['role'] = $_POST['role'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['user_id'] = $_POST['user_id'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['fullname'] = $_POST['first_name'] . " " . $_POST['last_name'];

if ($db->connect()) {
    $orm = new ORM($db);
    $sets = "username='{$_POST['username']}', password='{$_POST['password']}',
     first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}',
     gender='{$_POST['gender']}', role='{$_POST['role']}'";

    $file_object = $_FILES["user_profile"];
    $image_chosen = isset($file_object) && !empty($file_object["name"]);

    if ($image_chosen) {
        $image_uploaded = $orm->upload_file($file_object);
        if ($image_uploaded)
            $_SESSION['user_profile'] = $image_uploaded;
        $sets = $image_uploaded ? $sets . ", user_profile='{$image_uploaded}'" : $sets;
        if ($image_uploaded && $_POST['user_profile'] != 'null') {
            $orm->delete_file($_POST['user_profile']);
        }
    }

    $state = $orm->update('user', "user_id={$_POST['user_id']}", $sets);
    $db->close();

    if ($state) {
        header("Location: ../../views/account_info.php?msg='Updated successfully.'");
    } else {
        header("Location: ../../views/account_info.php?msg='Couldn't update.'");
    }
}

$db->close();
die('Server Connection Error');