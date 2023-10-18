<?php
include "../../models/ORM.php";
include "../../models/Database.php";
$db = new DataBase('library');

if ($db->connect()) {
    $orm = new ORM($db);

    $url = $_GET['url'];
    $user_id = $_GET['user_id'];
    $user_profile = $_GET['user_profile'];

    $state = $orm->delete('user', "user_id={$user_id}");
    if ($user_profile != 'null')
        $orm->delete_file($user_profile);
    $db->close();

    if ($url == 'logout') {
        header("Location: ../auth/logout.php");
    } else {
        $params = $_GET['params'];
        if ($state) {
            header("Location: ../../views/{$url}.php?msg='Removed successfully.'&{$params}");
        } else {
            header("Location: ../../views/{$url}.php?msg='Encountered error.'&{$params}");
        }
    }
}

$db->close();
die('Server Connection Error');